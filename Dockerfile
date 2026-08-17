FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev libpq-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring zip gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN touch database/database.sqlite

EXPOSE 10000
CMD php artisan serve --host=0.0.0.0 --port=$PORT
RUN chmod -R 775 storage bootstrap/cache
RUN php artisan migrate --force