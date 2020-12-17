FROM php:7.4-fpm
WORKDIR /PP2_group6/pp2_group6
COPY . /PP2_group6/pp2_group6
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install
RUN apt-get update && apt-get install -y \
        libpng-dev \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
        libonig-dev \
        zip \
        curl \
        unzip \
    && docker-php-ext-configure gd \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install zip \
    && docker-php-source delete


CMD ["php", "artisan", "serve"]
