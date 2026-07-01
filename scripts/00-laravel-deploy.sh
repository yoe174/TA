#!/usr/bin/env bash

echo "Running composer"
composer install --no-dev --working-dir=/var/www/html

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Running migrations..."
php artisan migrate --force

echo "Running seeders..."
php artisan db:seed --class=RoleAndUserSeeder --force

echo "Generating Shield permissions..."
php artisan shield:generate --all

echo "Linking storage..."
php artisan storage:link

echo "Done!"