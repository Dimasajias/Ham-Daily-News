<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AbsoluteSessionTimeout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $loggedInAt = session('logged_in_at');
            // Jika tidak ada data waktu login, set sekarang
            if (!$loggedInAt) {
                session(['logged_in_at' => now()->timestamp]);
            } else {
                // Periksa apakah sudah lewat dari 5 jam (18000 detik)
                if (now()->timestamp - $loggedInAt > 18000) {
                    auth()->logout();
                    session()->invalidate();
                    session()->regenerateToken();
                    return redirect()->route('login')->with('status', 'Sesi login 5 jam Anda telah habis. Silakan login kembali.');
                }
            }
        }

        return $next($request);
    }
}
