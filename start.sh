#!/bin/bash
set -e

echo "=== Running migrations ==="
php artisan migrate --force || echo "Migration failed, continuing..."

echo "=== Storage link ==="
php artisan storage:link || echo "Storage link failed, continuing..."

echo "=== Caching ==="
php artisan config:cache || echo "Config cache failed, continuing..."
php artisan route:cache || echo "Route cache failed, continuing..."

echo "=== Starting PHP server on port ${PORT:-8080} ==="
php -S 0.0.0.0:${PORT:-8080} -t public
