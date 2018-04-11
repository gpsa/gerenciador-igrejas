FROM php:7.1-apache

RUN apt-get update \
 && apt-get install -y git zlib1g-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng12-dev \
        libbz2-dev \
        wget \
        git \
        libicu-dev \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-configure intl \
    && docker-php-ext-install -j$(nproc) iconv mcrypt pdo pdo_mysql gd zip intl \
 && a2enmod rewrite \
 && sed -i 's!/var/www/html!/var/www/public!g' /etc/apache2/sites-available/000-default.conf \
 && mv /var/www/html /var/www/public \
 && curl -sS https://getcomposer.org/installer \
  | php -- --install-dir=/usr/local/bin --filename=composer

# Altera o GID,UID do usuario www-data
RUN NEWUID=1000 && \
NEWGID=1000 && \
LOGIN=www-data && \
GROUP=www-data && \
OLDUID=`id -u $LOGIN` && \
OLDGID=`id -g $GROUP` && \
usermod -u $NEWUID $LOGIN && \
groupmod -g $NEWGID $GROUP && \
find /var/www/ -user $OLDUID -exec chown -h $NEWUID {} \; && \
find /var/www/ -group $OLDGID -exec chgrp -h $NEWGID {} \;
#usermod -g $NEWGID $LOGIN

WORKDIR /var/www
