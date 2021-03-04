#!/usr/bin/env bash
set -e

source .env

if [ -z "$APP_KEY" ]; then
    echo "No application key found, setting and then exiting. Please start again.";
    php artisan key:generate
    exit 1;
fi

sudo -u www-data php artisan config:cache
sudo -u www-data php artisan migrate --force --seed

sudo -u www-data php artisan votesystem:admin

exec docker-php-entrypoint "$@"
