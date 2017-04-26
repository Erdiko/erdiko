############################################################
# PHP FPM Container for development
#
# Contains common and useful tools for development 
# and debugging
#
############################################################

FROM erdiko/php-fpm:latest
MAINTAINER John Arroyo <john@arroyolabs.com>

RUN apt-get update && apt-get install -y \
    libpq-dev 

# Xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# RUN usermod -u 1000 www-data
# CMD ["php-fpm"]