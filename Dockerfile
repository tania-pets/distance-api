FROM php:7.2-apache

# Basic lumen packages

RUN apt-get update && apt-get install -y \
        libmcrypt-dev \
        git \
        libzip-dev \
        zip \
        zlib1g-dev \
        && apt-get clean \
        && rm -rf /var/lib/apt/lists/*

#Install some base extensions
RUN docker-php-ext-configure zip --with-libzip \
&& docker-php-ext-install zip


# Enable rewrite module
RUN a2enmod rewrite

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Apache conf
ADD ./vhost.conf /etc/apache2/sites-enabled/000-default.conf


WORKDIR /var/www/html
