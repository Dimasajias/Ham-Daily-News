<?php

use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'index'])->name('public.index');
Route::get('/offices', [PublicController::class, 'offices'])->name('public.offices');
Route::get('/activity/{activity}', [PublicController::class, 'show'])->name('public.show');

require __DIR__.'/auth.php';
