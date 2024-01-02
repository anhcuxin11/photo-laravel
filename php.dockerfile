FROM php:8.0.5-fpm

RUN apt-get -y update

RUN apt-get install -y libzip-dev zip unzip libpng-dev libjpeg-dev zlib1g-dev procps vim libxml2-dev --no-install-recommends

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install php ext
RUN docker-php-ext-install pdo pdo_mysql soap zip exif gd

# RUN chmod -R 755 storage/logs

WORKDIR /var/www/html
