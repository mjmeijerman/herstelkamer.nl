FROM php:8.1-cli-alpine

RUN apk add --no-cache bash openssh

# Install PDO_mysql
RUN docker-php-ext-install pdo_mysql

# Install, configure, but do not enable Xdebug
RUN apk --no-cache add --virtual .build-dependencies \
        autoconf \
        g++ \
        make \
        git \
        libzip-dev \
        zip \
        freetype-dev \
        libjpeg-turbo-dev \
        libpng-dev \
        mysql-client \
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

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

#COPY xdebug.ini ${PHP_INI_DIR}/conf.d/xdebug.ini

VOLUME /opt/project
WORKDIR /opt/project
