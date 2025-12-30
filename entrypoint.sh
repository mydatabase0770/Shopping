#!/bin/sh
set -e

echo "Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Running migrations..."
php artisan migrate --force

echo "Starting Octane..."
php artisan octane:start --server=swoole --host=0.0.0.0 --port=8000
