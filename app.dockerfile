FROM php:8.2-fpm

RUN apt-get update && apt-get install -y  \
    libfreetype6-dev \
    libjpeg-dev \
    libpng-dev \
    libwebp-dev \
    --no-install-recommends \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql -j$(nproc) gd
    
FROM php:8.2-fpm

    RUN apt-get update && apt-get install -y  \
        libmagickwand-dev \
        --no-install-recommends \
        && pecl install imagick \
        && docker-php-ext-enable imagick \
        && docker-php-ext-install pdo_mysql