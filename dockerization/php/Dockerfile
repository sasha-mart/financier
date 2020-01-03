FROM php:7.4-fpm

RUN apt-get update && apt-get upgrade -y \
    && apt-get install -y \
    curl \
    wget \
    git \
    zip \
    unzip \
    zlib1g-dev libzip-dev \
    libfreetype6-dev \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo pdo_mysql mysqli zip \
    && if ! pecl list | grep xdebug; \
           then \
               pecl install xdebug \
               && docker-php-ext-enable xdebug; \
           fi
RUN docker-php-ext-install gd

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
