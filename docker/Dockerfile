# Use the official PHP image as the base image
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    curl \
    git \
    cron \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install zip \
    && docker-php-ext-install pdo_mysql

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Set working directory
WORKDIR /var/www/html

# Copie seu script de cron para o container (opcional)
COPY cron/laravel-cron /etc/cron.d/laravel-cron

# Defina as permissões corretas para o cron
RUN chmod 0644 /etc/cron.d/laravel-cron

# Aplicar os crons
RUN crontab /etc/cron.d/laravel-cron

# Iniciar o cron no background
CMD ["cron", "-f"]
