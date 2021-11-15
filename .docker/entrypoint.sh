#!/usr/bin/env bash
set -e

if [ -f .env ]; then
    source .env
fi

if [ -z "$APP_KEY" ]; then
    echo "No application key found, setting and then exiting. Please start again.";
    php artisan key:generate
    exit 1;
fi

if [ "$1" == "artisan" ]; then
    exec docker-php-entrypoint php "$@"
fi

if [ "$1" != "apache2-foreground" ]; then
    exec docker-php-entrypoint "$@"
fi

su www-data -s /bin/bash -c '
php artisan config:cache
php artisan migrate --force --seed
php artisan votesystem:admin
'

exec docker-php-entrypoint "$@"
