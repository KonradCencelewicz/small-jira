# Dockerfile

FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libicu-dev \
    libonig-dev \
    libzip-dev \
    zip \
    curl \
    libpng-dev \
    libxml2-dev \
    libpq-dev \
    libssl-dev \
    libcurl4-openssl-dev \
    libzip-dev \
    && docker-php-ext-install intl pdo_mysql zip mbstring xml opcache 

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/symfony

# Copy existing application directory contents
COPY . /var/www/symfony

# Install PHP dependencies
RUN composer install --no-interaction || cat /tmp/composer.log || true

# Set permissions for Symfony var/cache and var/log
RUN chown -R www-data:www-data var/cache var/log

# Expose port 9000 for php-fpm
EXPOSE 9000

CMD ["php-fpm"]