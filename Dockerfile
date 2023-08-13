#Dockerfile Example on running PHP Laravel app using Apache web server

FROM php:8.1-apache


# Set the working directory inside the container
WORKDIR /var/www/html

# Install required dependencies
RUN apt-get update && \
    apt-get install -y \
        libzip-dev \
        zip \
        unzip && \
    rm -rf /var/lib/apt/lists/*

# Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set up the debjit user (replace "debjit" with your desired username)
RUN groupadd --gid 1000 debjit && \
    useradd --uid 1000 --gid debjit --shell /bin/bash --create-home debjit

# Give ownership of the working directory to the debjit user
RUN chown -R debjit:debjit /var/www/html

# Switch to the debjit user
USER debjit

# Copy the Laravel application files into the container
COPY . /var/www/html

# Expose port 8000 (you can change this if you are using a different port)
EXPOSE 8000

# Command to run the Laravel application using the built-in PHP development server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
