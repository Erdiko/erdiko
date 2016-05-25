#!/bin/sh

# after install run this in your instance
a2enmod rewrite
# a2enmod ssl

# point apache to the correct webroot
rm -rf /var/www/html
ln -s /var/www/code/public /var/www/html

# copy apache config(s)
cp apache2.conf /etc/apache2/apache2.conf
cp 000-default.conf /etc/apache2/sites-available/000-default.conf
# cp default-ssl.conf /etc/apache2/sites-available/default-ssl.conf

# restart apache
service apache2 restart
