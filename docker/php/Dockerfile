FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    nginx \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    default-mysql-client \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY src/ /var/www/html

RUN composer install --no-dev --optimize-autoloader

COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf
COPY scripts/start.sh /start.sh

RUN chmod +x /start.sh \
    && mkdir -p /run/php

EXPOSE 80

CMD ["/start.sh"]