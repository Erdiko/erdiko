#!/bin/sh

# Install Phpunit, https://phpunit.de
wget https://phar.phpunit.de/phpunit-5.7.phar
chmod +x phpunit.phar
mv phpunit.phar /usr/local/bin/phpunit
phpunit --version
