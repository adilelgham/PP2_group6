FROM php:fpm-alpine
WORKDIR /pp2_group6
COPY . /pp2_group6
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user
CMD ["php", "artisan", "serve"]

USER $user