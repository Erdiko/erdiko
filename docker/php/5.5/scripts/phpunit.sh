#!/bin/sh

# Install Phpunit, https://phpunit.de
wget https://phar.phpunit.de/phpunit-4.8.phar
chmod +x phpunit-4.8.phar
mv phpunit-4.8.phar /usr/local/bin/phpunit
phpunit --version
