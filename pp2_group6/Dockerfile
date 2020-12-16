FROM php:fpm-alpine
WORKDIR /PP2_group6/pp2_group6
COPY . /PP2_group6/pp2_group6
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN apt-get update -y && apt-get install -y libmcrypt-dev openssl
RUN docker-php-ext-install pdo mcrypt mbstring
RUN adduser -D -u 1000 student
RUN mkdir -p /home/student/.composer && \
    chown -R student:student /home/student
CMD ["php", "artisan", "serve"]