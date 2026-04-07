#!/usr/bin/env bash
set -e

cd /var/www/html

mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/logs
mkdir -p bootstrap/cache

chmod -R 777 storage bootstrap/cache || true

rm -f bootstrap/cache/*.php || true

php artisan config:cache
php artisan route:cache
php artisan view:cache

php artisan migrate --force

php-fpm -D
nginx -g "daemon off;"