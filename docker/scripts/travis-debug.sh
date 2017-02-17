#!/bin/sh

phpunit -h

wget https://phar.phpunit.de/phpunit.phar
chmod +x phpunit.phar
mv phpunit.phar /usr/local/bin/phpunit

phpunit --version
phpunit -h
