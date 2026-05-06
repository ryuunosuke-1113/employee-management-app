#!/bin/sh

cd /var/www/src

php artisan config:clear
php artisan route:clear
php artisan view:clear

touch database/database.sqlite

php artisan key:generate --force
php artisan migrate --seed --force

php-fpm -D
nginx -g "daemon off;"