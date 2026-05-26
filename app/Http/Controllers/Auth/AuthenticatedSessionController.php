<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view with CAPTCHA challenge.
     */
    public function create(Request $request): View
    {
        // Generate CAPTCHA: soal matematika sederhana
        $num1 = random_int(1, 20);
        $num2 = random_int(1, 20);
        $operators = ['+', '-'];
        $operator = $operators[array_rand($operators)];

        $answer = match ($operator) {
            '+' => $num1 + $num2,
            '-' => $num1 - $num2,
        };

        // Simpan jawaban di session
        $request->session()->put('captcha_answer', $answer);

        return view('auth.login', [
            'captcha_question' => "{$num1} {$operator} {$num2} = ?",
        ]);
    }

    /**
     * Handle an incoming authentication request.
     * Setelah kredensial valid → langsung login (tanpa OTP).
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('filament.admin.pages.dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
