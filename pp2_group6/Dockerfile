FROM php:7.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
# mod_rewrite for URL rewrite and mod_headers for .htaccess extra headers like Access-Control-Allow-Origin-
RUN a2enmod rewrite headers

# start with base php config, then add extensions
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

RUN docker-php-ext-install \
    intl \
    iconv \
    bcmath \
    opcache \
    calendar \
    mbstring \
    pdo_mysql \
    zip
# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY . /var/www/html
RUN cd /var/www/html && php artisan key:generate
# COPY . /PP2_group6/pp2_group6
ARG uid
# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/student student
RUN mkdir -p /home/student/.composer && \
    chown -R $user:student /home/student