#!/usr/bin/env sh

# Собираем и поднимаем контейнеры
docker-compose up -d --build

docker-compose exec php-fpm cp .env.example .env

# Обновляем composer
docker-compose exec php-fpm composer update

# Копируем файл для нормальной работы FacebookSDK
docker-compose exec php-fpm cp GraphRawResponse.php vendor/facebook/graph-sdk/src/Facebook/Http/GraphRawResponse.php

# Миграция таблиц в БД
docker-compose exec php-fpm php artisan migrate

# Папка для хранения аватарок
docker-compose exec php-fpm mkdir -p storage/app/public/user/avatars

docker-compose exec php-fpm chmod -R 777 storage

echo "Done!"
