<?php

namespace App\Providers;

use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // ──── Kebijakan Kata Sandi Kuat (Global) ────
        Password::defaults(function () {
            return Password::min(8)
                ->letters()       // Wajib mengandung huruf
                ->mixedCase()     // Wajib huruf besar + kecil
                ->numbers()       // Wajib mengandung angka
                ->symbols();      // Wajib mengandung simbol (!@#$%^&*)
        });

        // ──── Audit Login: Catat Login Sukses ────
        Event::listen(Login::class, function (Login $event) {
            \Illuminate\Support\Facades\Log::channel('stack')->info('LOGIN SUKSES', [
                'user_id'    => $event->user->id,
                'user_name'  => $event->user->name,
                'email'      => $event->user->email,
                'ip'         => request()->ip(),
                'user_agent' => request()->userAgent(),
                'timestamp'  => now()->toDateTimeString(),
            ]);
        });

        // ──── Audit Login: Catat Login Gagal ────
        Event::listen(Failed::class, function (Failed $event) {
            \Illuminate\Support\Facades\Log::channel('stack')->warning('LOGIN GAGAL', [
                'email'      => $event->credentials['email'] ?? '-',
                'ip'         => request()->ip(),
                'user_agent' => request()->userAgent(),
                'timestamp'  => now()->toDateTimeString(),
            ]);
        });
    }
}

