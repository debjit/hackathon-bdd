# Use the official PHP with Apache image as the base image
FROM php:8.1-apache

# Set the working directory inside the container
WORKDIR /var/www/html

# Install required PHP extensions and other dependencies
RUN apt-get update && \
    apt-get install -y \
        libzip-dev \
        zip \
        unzip && \
    docker-php-ext-install zip && \
    rm -rf /var/lib/apt/lists/*

# Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy the Laravel application files into the container
COPY . /var/www/html

# Give ownership of the working directory to the www-data user (Apache user)
RUN chown -R www-data:www-data /var/www/html

# Expose port 80 (default for Apache)
EXPOSE 80

# Start the Apache web server
CMD ["apache2-foreground"]
