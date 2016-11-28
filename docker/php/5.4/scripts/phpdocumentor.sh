#!/bin/sh

# Install phpDocumentor, http://phpdoc.org/
wget http://phpdoc.org/phpDocumentor.phar
chmod +x phpDocumentor.phar
mv phpDocumentor.phar /usr/local/bin/phpdocumentor
