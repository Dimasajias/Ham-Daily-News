<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 * Router script for PHP built-in server.
 * This ensures static files (CSS, JS, images) are served correctly.
 */

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// If the requested file exists as a static file, serve it directly
if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    $path = __DIR__.'/public'.$uri;
    
    // Set proper MIME types
    $extension = pathinfo($path, PATHINFO_EXTENSION);
    $mimeTypes = [
        'css' => 'text/css',
        'js' => 'application/javascript',
        'json' => 'application/json',
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif' => 'image/gif',
        'svg' => 'image/svg+xml',
        'ico' => 'image/x-icon',
        'woff' => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf' => 'font/ttf',
        'mp4' => 'video/mp4',
        'webp' => 'image/webp',
    ];
    
    if (isset($mimeTypes[$extension])) {
        header('Content-Type: ' . $mimeTypes[$extension]);
    }
    
    readfile($path);
    return true;
}

// Otherwise, route through Laravel
require_once __DIR__.'/public/index.php';
