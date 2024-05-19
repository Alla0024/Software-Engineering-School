FROM php:8.2-fpm

WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Create a non-root user
RUN useradd -m laravel

# Change ownership of the working directory
RUN chown -R laravel:laravel /var/www

# Switch to the non-root user
USER laravel

COPY --chown=laravel:laravel . .

# Install Composer dependencies
RUN composer install

COPY --chown=laravel:laravel . /var/www

# Expose port 8000 and start the PHP built-in server
CMD php artisan serve --host=0.0.0.0 --port=8000
