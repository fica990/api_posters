#!/usr/bin/env bash

echo "Starting Docker..."

export MSYS_NO_PATHCONV=1;
docker-compose up --build -d

echo "Installing composer..."
docker exec my_php bash -c "composer install && composer dump-autoload"

echo "Running migrations..."
docker exec my_php bash -c "php artisan migrate"

echo "Creating symlink for images..."
docker exec my_php bash -c "php artisan storage:link"