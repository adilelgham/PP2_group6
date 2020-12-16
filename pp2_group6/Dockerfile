FROM php:fpm-alpine
WORKDIR /PP2_group6/pp2_group6
COPY . /PP2_group6/pp2_group6
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN adduser -D -u 1000 student
RUN mkdir -p /home/student/.composer && \
    chown -R student:student /home/student
RUN composer install
RUN apt-get update && apt-get install -y --force-yes \
    freetds-dev \
    libicu-dev \
    libpq-dev \
    libmcrypt-dev \
    libpng-dev \
    git \
 && rm -r /var/lib/apt/lists/* \
 && cp -s /usr/lib/x86_64-linux-gnu/libsybdb.so /usr/lib/ \
 && docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd \
 && docker-php-ext-install \
    gd \
    mbstring \
    mcrypt \
    pcntl \
    pdo_dblib \
    pdo_mysql \
    pdo_pgsql \
    zip


CMD ["php", "artisan", "serve"]
