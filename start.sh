#!/bin/bash
set -e

php artisan config:clear || true
php artisan cache:clear || true

php artisan migrate --force

php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

apache2-foreground