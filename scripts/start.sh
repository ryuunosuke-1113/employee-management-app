#!/usr/bin/env bash
set -e

cd /var/www

echo "===> Waiting for MySQL to be ready..."
until mysql -h mysql -u laravel -ppassword -e "SELECT 1" >/dev/null 2>&1; do
  sleep 2
done

echo "===> Installing PHP dependencies..."
composer install

echo "===> Preparing Laravel directories..."
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/logs
mkdir -p bootstrap/cache

chown -R www-data:www-data storage bootstrap/cache || true
chmod -R 775 storage bootstrap/cache || true

echo "===> Preparing environment file..."
if [ ! -f .env ]; then
  cp .env.example .env
fi

echo "===> Generating app key..."
php artisan key:generate

echo "===> Clearing caches..."
php artisan optimize:clear

echo "===> Running migrations and seeders..."
php artisan migrate --seed --force

echo "===> Installing Node dependencies..."
npm install

echo "===> Building frontend assets..."
npm run build

echo "===> Starting php-fpm..."
php-fpm -F