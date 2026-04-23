<?php

/**
 * FILE INI HANYA UNTUK DEPLOYMENT KE HOSTING SEPERTI INFINITYFREE
 * BILA ANDA MENGGUNAKAN CARA UPLOAD SEMUA FILE KE DALAM FOLDER HTDOCS.
 *
 * Bila .htaccess di root sudah bekerja dan mengalihkan trafik ke /public, 
 * file ini sebenarnya tidak akan banyak tereksekusi. Namun bila hosting 
 * Anda tidak mendukung redirect htaccess, file ini bertindak sebagai pintu masuk.
 */

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Tentukan apakah aplikasi sedang maintenance...
if (file_exists($maintenance = __DIR__.'/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Daftarkan Composer autoloader...
require __DIR__.'/vendor/autoload.php';

// Menjalankan Laravel dari folder root (bukan dari public)
(require_once __DIR__.'/bootstrap/app.php')
    ->handleRequest(Request::capture());
