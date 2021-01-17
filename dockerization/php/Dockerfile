FROM php:7.4-fpm

RUN apt-get update && \
    apt-get install -y \
    curl \
    bash \
    wget \
    git \
    zip \
    unzip \
    zlib1g-dev libzip-dev \
    libfreetype6-dev
RUN docker-php-ext-install -j$(nproc) gd
RUN docker-php-ext-install pdo pdo_mysql mysqli zip
RUN if ! pecl list | grep xdebug; \
           then \
               pecl install xdebug \
               && docker-php-ext-enable xdebug; \
           fi

COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY php.ini /usr/local/etc/php/conf.d/
COPY xdebug.ini  /usr/local/etc/php/conf.d/

WORKDIR /usr/src/backend
CMD ["php-fpm"]