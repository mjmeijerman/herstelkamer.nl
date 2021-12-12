FROM php:8.1-fpm-alpine

RUN apk add --no-cache bash

# Install PDO_mysql
RUN docker-php-ext-install pdo_mysql mysqli

# Install, configure, but do not enable Xdebug
RUN apk --no-cache add --virtual .build-dependencies \
        autoconf \
        g++ \
        make \
        libzip-dev \
        zip \
        freetype-dev \
        libjpeg-turbo-dev \
        libpng-dev \
    && docker-php-ext-install \
        bcmath \
        sockets \
    && docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg \
    && docker-php-ext-install zip \
    && docker-php-ext-install gd \
    && docker-php-ext-install exif \
    && docker-php-ext-install pcntl \
    && docker-php-ext-install posix
#    && pecl install xdebug-3.0.4 \
#    && docker-php-ext-enable xdebug

#COPY xdebug.ini ${PHP_INI_DIR}/conf.d/xdebug.ini

# Install Composer
RUN apk --no-cache add zlib-dev \
    && docker-php-ext-install zip
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

VOLUME /opt/project
WORKDIR /opt/project
