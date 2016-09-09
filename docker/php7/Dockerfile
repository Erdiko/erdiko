############################################################
# PHP FPM Container
############################################################

FROM php:fpm

# File Author / Maintainer
MAINTAINER John Arroyo, john@arroyolabs.com

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update \
    && apt-get install -y wget \
        mysql-client \
        curl \
        pwgen \
        libmcrypt-dev \
    && docker-php-ext-install mysqli \
        pdo_mysql \
        mcrypt \
        mbstring \
    && apt-get clean

EXPOSE 9000

CMD ["php-fpm"]