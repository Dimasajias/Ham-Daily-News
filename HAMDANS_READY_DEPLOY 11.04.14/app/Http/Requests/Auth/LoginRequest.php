<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'email'   => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
            'captcha'  => ['required', 'integer'],
        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [
            'captcha.required' => 'Jawaban CAPTCHA wajib diisi.',
            'captcha.integer'  => 'Jawaban CAPTCHA harus berupa angka.',
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // ──── Validasi CAPTCHA ────
        $captchaAnswer = $this->session()->get('captcha_answer');
        if ((int) $this->captcha !== (int) $captchaAnswer) {
            RateLimiter::hit($this->throttleKey(), 60);

            throw ValidationException::withMessages([
                'captcha' => 'Jawaban CAPTCHA salah. Silakan coba lagi.',
            ]);
        }

        // ──── Autentikasi Kredensial ────
        // Fitur "Remember Me" dihapus demi keamanan sesi
        if (! Auth::attempt($this->only('email', 'password'), false)) {
            RateLimiter::hit($this->throttleKey(), $this->getLockoutDuration());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     * Maksimal 3 percobaan login gagal sebelum dikunci sementara.
     * Progressive lockout: semakin banyak gagal → semakin lama dikunci.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 3)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        // Log percobaan brute force
        Log::warning('BRUTE FORCE DETECTED', [
            'email'      => $this->email,
            'ip'         => $this->ip(),
            'user_agent' => $this->userAgent(),
            'locked_for' => $seconds . ' seconds',
        ]);

        throw ValidationException::withMessages([
            'email' => "Terlalu banyak percobaan login. Silakan tunggu {$seconds} detik sebelum mencoba lagi.",
        ]);
    }

    /**
     * Get progressive lockout duration based on failed attempts.
     * 1-3 gagal: 60 detik, 4-6 gagal: 300 detik, 7+: 900 detik
     */
    protected function getLockoutDuration(): int
    {
        $attempts = RateLimiter::attempts($this->throttleKey());

        return match (true) {
            $attempts >= 7 => 900,  // 15 menit
            $attempts >= 4 => 300,  // 5 menit
            default        => 60,   // 1 menit
        };
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}

