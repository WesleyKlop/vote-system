#!/usr/bin/env bash
set -e

php artisan config:cache
php artisan migrate --force

exec docker-php-entrypoint "$@"
