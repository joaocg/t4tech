#!/bin/bash

# Function to check MySQL connection
check_db_connection() {
    php -r "
    try {
        new PDO(
            'mysql:host=${DB_HOST};dbname=${DB_DATABASE}',
            '${DB_USERNAME}',
            '${DB_PASSWORD}',
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
        exit(0);
    } catch (Exception \$e) {
        exit(1);
    }"
}

# Wait for the database to be ready
until check_db_connection; do
    echo "Waiting for MySQL to be ready..."
    sleep 5
done

echo "MySQL is ready. Running Laravel commands..."

# Run Laravel commands
composer install
php artisan key:generate
php artisan migrate --force
php artisan db:seed --force
php artisan optimize

# Start PHP-FPM
exec php-fpm