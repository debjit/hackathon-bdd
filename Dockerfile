
# FROM php:8.1-apache

# # Install necessary libraries
# RUN apt-get update && apt-get install -y \
#     libonig-dev \
#     libzip-dev

# # Install PHP extensions
# RUN docker-php-ext-install \
#     mbstring \
#     zip
FROM laravelsail/php81-composer

RUN apt-get update -y && apt-get install -y libpng-dev zlib1g-dev libicu-dev g++

RUN docker-php-ext-configure intl

RUN docker-php-ext-install exif gd intl zip
# Copy Laravel application
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Install Composer
COPY --from=composer:latestusr/bin/composer / /usr/bin/composer

# Install dependencies
RUN composer install

# Change ownership of our applications
RUN chown -R www-data:www-data /var/www/html

# Install missing mbstring extension
RUN docker-php-ext-install mbstring

COPY .env.example .env
RUN php artisan key:generate

# Expose port 80
EXPOSE 80

# Adjusting Apache configurations
COPY docker/apache-config.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite
