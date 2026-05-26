<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\OtpCode;
use App\Models\User;
use App\Notifications\OtpNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\View\View;

class OtpVerificationController extends Controller
{
    /**
     * Tampilkan halaman input OTP.
     */
    public function show(Request $request): View|RedirectResponse
    {
        // Pastikan ada user_id di session (dari proses login sebelumnya)
        if (!$request->session()->has('otp_user_id')) {
            return redirect()->route('login')
                ->with('status', 'Sesi verifikasi telah berakhir. Silakan login kembali.');
        }

        return view('auth.verify-otp', [
            'email' => $request->session()->get('otp_email'),
        ]);
    }

    /**
     * Verifikasi kode OTP yang diinput user.
     */
    public function verify(Request $request): RedirectResponse
    {
        $request->validate([
            'otp_code' => ['required', 'string', 'size:6'],
        ]);

        $userId = $request->session()->get('otp_user_id');

        if (!$userId) {
            return redirect()->route('login')
                ->with('status', 'Sesi verifikasi telah berakhir. Silakan login kembali.');
        }

        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('login')
                ->with('status', 'User tidak ditemukan.');
        }

        // Verifikasi kode OTP
        if (!OtpCode::verifyFor($user, $request->otp_code)) {
            return back()->withErrors([
                'otp_code' => 'Kode OTP salah atau sudah kadaluarsa. Silakan coba lagi.',
            ]);
        }

        // OTP valid → Login user
        Auth::login($user);
        $request->session()->regenerate();

        // Bersihkan data OTP dari session
        $request->session()->forget(['otp_user_id', 'otp_email']);

        return redirect()->intended('/admin');
    }

    /**
     * Kirim ulang kode OTP.
     */
    public function resend(Request $request): RedirectResponse
    {
        $userId = $request->session()->get('otp_user_id');

        if (!$userId) {
            return redirect()->route('login')
                ->with('status', 'Sesi verifikasi telah berakhir. Silakan login kembali.');
        }

        // Rate limit: 1 resend per 60 detik
        $key = 'otp-resend:' . $userId;
        if (RateLimiter::tooManyAttempts($key, 1)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->with('resend_wait', $seconds);
        }

        $user = User::find($userId);

        if ($user) {
            $otp = OtpCode::generateFor($user);
            $user->notify(new OtpNotification($otp->plain_code));
            RateLimiter::hit($key, 60);
        }

        return back()->with('status', 'Kode OTP baru telah dikirim ke email Anda.');
    }
}
