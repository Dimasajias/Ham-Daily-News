<?php

/**
 * CUSTOM INDEX.PHP UNTUK INFINITYFREE / SHARED HOSTING
 *
 * CARA PENGGUNAAN:
 * 1. Upload SEMUA ISI folder proyek Laravel (app, bootstrap, config, vendor, storage, dll)
 *    langsung ke dalam folder htdocs/ di InfinityFree.
 * 2. Upload juga semua isi folder public/ Laravel (index.php ini, .htaccess, build/, images/, css/, js/)
 *    langsung ke dalam htdocs/ (menimpa/merge, bukan di dalam subfolder).
 * 3. File index.php ini menggantikan public/index.php bawaan Laravel.
 */

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Path ke root proyek Laravel (satu folder di atas file ini, yaitu folder proyek itu sendiri)
// Karena semua file sudah ada di htdocs, kita pakai __DIR__ langsung
$laravelRoot = __DIR__;

// Tentukan apakah aplikasi sedang maintenance...
if (file_exists($maintenance = $laravelRoot . '/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Daftarkan Composer autoloader...
require $laravelRoot . '/vendor/autoload.php';

// Menjalankan Laravel — arahkan ke bootstrap/app.php
(require_once $laravelRoot . '/bootstrap/app.php')
    ->handleRequest(Request::capture());
