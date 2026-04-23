<?php

use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'index'])->name('public.index');
Route::get('/kegiatan', [PublicController::class, 'kegiatan'])->name('public.kegiatan');
Route::get('/offices', [PublicController::class, 'offices'])->name('public.offices');
Route::get('/export/kegiatan', [PublicController::class, 'export'])->name('public.export');
Route::get('/activity/{activity}', [PublicController::class, 'show'])->name('public.show');
Route::get('/hoax', [PublicController::class, 'hoax'])->name('public.hoax');
Route::get('/hoax/{hoax}', [PublicController::class, 'showHoax'])->name('public.hoax.show');

require __DIR__.'/auth.php';

// Route khusus untuk menginstall database di shared hosting seperti InfinityFree
Route::get('/install-database', function () {
    \Illuminate\Support\Facades\Artisan::call('migrate:fresh', [
        '--force' => true,
        '--seed' => true
    ]);
    return 'Database berhasil di-install dan di-isi data awal (termasuk akun Admin)! Silakan hapus rute ini jika sudah berhasil demi keamanan.';
});
