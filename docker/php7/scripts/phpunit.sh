#!/bin/sh

# Install Phpunit, https://phpunit.de
wget https://phar.phpunit.de/phpunit.phar
chmod +x phpunit.phar
mv phpunit.phar /usr/local/bin/phpunit
