FROM php:7.3-apache

RUN apt-get update \
    && apt-get install -y git zlib1g-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libbz2-dev \
    wget \
    git \
    libicu-dev \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-configure intl \
    && docker-php-ext-install -j$(nproc) iconv pdo pdo_mysql gd zip intl \
    && a2enmod rewrite \
    && sed -i 's!/var/www/html!/var/www/public!g' /etc/apache2/sites-available/000-default.conf \
    && mv /var/www/html /var/www/public \
    && curl -sS https://getcomposer.org/installer \
    | php -- --install-dir=/usr/local/bin --filename=composer \
    && echo "AllowEncodedSlashes On" >> /etc/apache2/apache2.conf
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

# XDEBUG
RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini

WORKDIR /var/www
