# docker/Dockerfile
FROM php:8.1-fpm-bullseye

# Get frequently used tools
RUN apt-get update && apt-get install -y \
    build-essential \
    libicu-dev \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    locales \
    zip \
    unzip \
    jpegoptim optipng pngquant gifsicle \
    git \
    curl \
    wget

RUN docker-php-ext-configure zip

RUN docker-php-ext-install \
        bcmath \
        mbstring \
        pcntl \
        intl \
        zip \
        opcache

# apcu for caching, xdebug for debugging and also phpunit coverage
RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Copy and run composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN composer install --no-interaction

CMD ["php-fpm"]