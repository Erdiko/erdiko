#!/bin/sh

# Install Phpunit, https://phpunit.de
wget https://phar.phpunit.de/phpunit-5.7.phar
chmod +x phpunit-5.7.phar
mv phpunit-5.7.phar /usr/local/bin/phpunit
phpunit --version
