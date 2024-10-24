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
    supervisor \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install zip \
    && docker-php-ext-install pdo_mysql

# Instalar o Composer
COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Copy the Laravel application code
COPY . /var/www/html

# Add a cron job (run Laravel scheduler every minute)
RUN echo "* * * * * www-data php /var/www/html/artisan schedule:run >> /dev/null 2>&1" >> /etc/cron.d/laravel

# Give the file correct permissions
RUN chmod 0644 /etc/cron.d/laravel

# Apply cron job
RUN crontab /etc/cron.d/laravel

# Copy supervisord config
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf


# Set working directory
WORKDIR /var/www/html

# Ensure cron is started and run supervisord to manage processes
CMD ["/usr/bin/supervisord"]

######

