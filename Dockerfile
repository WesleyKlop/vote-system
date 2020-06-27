FROM node:alpine as front-builder
WORKDIR /app

# Copy package manager files, and vendor because that way laravel-mix knows that it's laravel
COPY package.json yarn.lock webpack.mix.js tailwind.config.js artisan ./
RUN yarn --frozen-lockfile

COPY resources ./resources
RUN yarn production

FROM composer:latest as back-builder
WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install \
    --ignore-platform-reqs \
    --no-ansi \
    --no-autoloader \
    --no-dev \
    --no-interaction \
    --no-scripts

COPY . .
RUN composer dump-autoload -a

# Build app image
FROM php:7.4-apache

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/
RUN install-php-extensions opcache pgsql pdo_pgsql bcmath mysqli pdo_mysql

RUN a2enmod rewrite

ADD .docker/apache.conf /etc/apache2/sites-available/000-default.conf
ADD .docker/php.ini ${PHP_INI_DIR}/conf.d/99-overrides.ini
ADD .docker/entrypoint.sh /usr/local/bin/entrypoint.sh

WORKDIR /app
COPY --from=back-builder /app /app
COPY --from=front-builder /app/public /app/public

RUN chgrp -R www-data /app/storage /app/bootstrap/cache && chmod -R 770 /app/storage /app/bootstrap/cache
# Cache everything except config cache because .env is loaded at container creation time.
RUN php artisan route:cache && php artisan view:cache

ENTRYPOINT ["entrypoint.sh"]
CMD ["apache2-foreground"]
