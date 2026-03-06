#!/bin/bash

echo "=== Running migrations ==="
php artisan migrate --force || true

echo "=== Publishing Filament assets ==="
php artisan filament:assets || true

echo "=== Storage link ==="
php artisan storage:link || true

echo "=== Starting server on port ${PORT:-8080} ==="
php artisan serve --host=0.0.0.0 --port=${PORT:-8080} --no-reload
