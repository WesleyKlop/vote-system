FROM node:17 as front-builder
WORKDIR /app

# Copy package manager files, and vendor because that way laravel-mix knows that it's laravel
COPY package.json package-lock.json webpack.mix.js tailwind.config.js .babelrc postcss.config.js artisan ./
RUN npm ci

COPY resources ./resources
RUN npm run production

FROM composer:2 as back-builder
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
FROM php:8-apache

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/
RUN install-php-extensions opcache pgsql pdo_pgsql bcmath mysqli pdo_mysql pcntl

RUN a2enmod rewrite

COPY .docker/apache.conf /etc/apache2/sites-available/000-default.conf
COPY .docker/php.ini ${PHP_INI_DIR}/conf.d/99-overrides.ini
COPY .docker/entrypoint.sh /usr/local/bin/entrypoint.sh

WORKDIR /app
COPY --chown=www-data:www-data --from=back-builder /app/ /app
COPY --chown=www-data:www-data --from=front-builder /app/public/ /app/public

VOLUME /app/storage/logs
VOLUME /app/storage/app

# Cache everything except config cache because .env is loaded at container creation time.
USER www-data
RUN php artisan route:cache \
 && php artisan event:cache \
 && php artisan view:cache
USER root

ENTRYPOINT ["entrypoint.sh"]
CMD ["apache2-foreground"]
