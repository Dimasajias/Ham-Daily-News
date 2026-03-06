#!/bin/bash

echo "=== Running migrations ==="
php artisan migrate --force || true

echo "=== Publishing Filament assets ==="
php artisan filament:assets || true

echo "=== Storage link ==="
php artisan storage:link || true

echo "=== Starting PHP server on port ${PORT:-8080} with router ==="
php -S 0.0.0.0:${PORT:-8080} server.php
