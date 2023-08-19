FROM php:8.1-apache

# Install necessary libraries
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev \
    libicu-dev

# Install PHP extensions
RUN docker-php-ext-install \
    mbstring \
    zip \
    intl

# Copy Laravel application
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install dependencies
# RUN composer install
RUN composer upgrade

# Change ownership of our applications
RUN chown -R www-data:www-data /var/www/html

RUN docker-php-ext-install mbstring

COPY .env.example .env
RUN php artisan key:generate
RUN php artisan storage:link

# Expose port 8000
EXPOSE 8000

# Adjusting Apache configurations
RUN a2enmod rewrite
COPY /docker/apache-config.conf /etc/apache2/sites-available/000-default.conf
