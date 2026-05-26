<?php
// Script untuk memperbaiki path cache Laravel di Shared Hosting
$paths = [
    __DIR__ . '/storage/framework/cache/data',
    __DIR__ . '/storage/framework/sessions',
    __DIR__ . '/storage/framework/views',
    __DIR__ . '/bootstrap/cache',
];

foreach ($paths as $path) {
    if (!is_dir($path)) {
        mkdir($path, 0775, true);
        echo 'Membentuk folder: ' . $path . '<br>';
    }
    chmod($path, 0775);
    echo 'Memperbaiki izin: ' . $path . '<br>';
}

file_put_contents(__DIR__ . '/bootstrap/cache/config.php', '<?php return [];');
echo 'Cache Config dibersihkan!<br>';
echo 'Silakan coba akses website kembali.';

