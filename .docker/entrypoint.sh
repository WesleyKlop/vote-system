#!/usr/bin/env bash
set -e

source .env

if [ -z "$APP_KEY" ]; then
    echo "No application key found, setting and then exiting. Please start again.";
    php artisan key:generate
    exit 1;
fi

su www-data -s /bin/bash -c '
php artisan config:cache
php artisan migrate --force --seed
php artisan votesystem:admin
'

exec docker-php-entrypoint "$@"
