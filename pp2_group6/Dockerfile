FROM php:fpm-alpine
WORKDIR /PP2_group6/pp2_group6
COPY . /PP2_group6/pp2_group6
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN adduser -D -u 1000 student
RUN mkdir -p /home/student/.composer && \
    chown -R student:student /home/student
RUN composer install
RUN npm install
CMD ["php", "artisan", "serve"]
