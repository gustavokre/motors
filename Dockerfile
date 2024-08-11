FROM php:8.2-fpm

# set your user name, ex: user=bernardo
ARG user
ARG uid

# Install system dependencies
RUN apt-get update
RUN apt-get install -y git
RUN apt-get install -y curl
RUN apt-get install -y libjpeg-dev
RUN apt-get install -y libpng-dev
RUN apt-get install -y libwebp-dev
RUN apt-get install -y libonig-dev
RUN apt-get install -y libxml2-dev
RUN apt-get install -y libzip-dev
RUN apt-get install -y libicu-dev
RUN apt-get install -y zip
RUN apt-get install -y unzip
RUN apt-get install -y libmcrypt-dev
RUN apt-get install -y libmemcached-dev
RUN apt-get install -y libfreetype6-dev
RUN apt-get install -y libjpeg62-turbo-dev
RUN apt-get install -y default-mysql-client
RUN apt-get install -y default-libmysqlclient-dev
RUN apt-get install -y supervisor
RUN apt-get install -y build-essential
RUN apt-get install -y openssl

# Install Node.js and npm
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*


# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure gd --with-jpeg --with-webp --with-freetype
RUN docker-php-ext-install -j$(nproc) gd

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install exif
RUN docker-php-ext-install pcntl
RUN docker-php-ext-install bcmath
RUN docker-php-ext-install sockets
RUN docker-php-ext-install intl
RUN docker-php-ext-install zip
RUN docker-php-ext-install calendar

RUN docker-php-ext-install soap \
    && docker-php-ext-enable soap

RUN docker-php-ext-configure intl \
    && docker-php-ext-enable intl

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www

# Copy custom configurations PHP
COPY docker/php/custom.ini /usr/local/etc/php/conf.d/custom.ini

# Xdebug
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
COPY docker/php/90-xdebug.ini /usr/local/etc/php/conf.d/90-xdebug.ini

USER $user
