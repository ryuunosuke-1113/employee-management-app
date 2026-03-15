FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    libzip-dev \
    zip \
    curl \
    && docker-php-ext-install pdo pdo_pgsql zip \
    && a2enmod rewrite

WORKDIR /var/www/html

COPY . /var/www/html

# Apache の公開ディレクトリを public に変更
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Composer インストール
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader

# Laravel 用の権限
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Render 起動時に migration / cache を実行するためのスクリプト
COPY start.sh /start.sh
RUN chmod +x /start.sh

CMD ["/start.sh"]