#!/usr/bin/env bash

echo "Starting Docker..."

export MSYS_NO_PATHCONV=1;
docker-compose up --build -d

echo "Installing composer..."
docker exec poster_php bash -c "composer install && composer dump-autoload"

echo "Running migrations..."
docker exec poster_php bash -c "php artisan key:generate"

echo "Running migrations..."
docker exec poster_php bash -c "php artisan migrate --seed"

echo "Creating symlink for images..."
docker exec poster_php bash -c "php artisan storage:link"