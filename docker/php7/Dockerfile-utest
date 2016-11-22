############################################################
# PHP FPM container for unit testing and debugging
#
# Contains common and useful...
# php extensions: mcrypt, gd, mysql
# linux packages: mysql-client, git, curl, wget, pwgen
#
# coming soon: redis, memcached, xdebug
#
# This is a good container for php development and includes 
# common tools needed in a PHP app.  Use with or without 
# Erdiko. 
# 
# This container is intended for development and CI only!
############################################################

FROM php:fpm

# File Author / Maintainer
MAINTAINER John Arroyo, john@arroyolabs.com

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update \
    && apt-get install -y wget \
        git \
        mysql-client \
        curl \
        wget \
        pwgen \
        libmcrypt-dev \
        libpng-dev \
    # && mkdir -p /usr/src/php/ext/redis \
    # && git clone -b php7 https://github.com/phpredis/phpredis.git /usr/src/php/ext/redis \
    && docker-php-ext-install mysqli \
        pdo_mysql \
        mcrypt \
        # redis \
        gd \
    # && docker-php-ext-enable memcached \
    && apt-get clean

# Install additional scripts (composer and phpunit)
COPY scripts /src
RUN cd /src && chmod 770 *.sh
RUN /src/composer.sh
RUN /src/phpunit.sh

EXPOSE 9000

CMD ["php-fpm"]
