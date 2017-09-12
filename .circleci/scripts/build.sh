#!/bin/sh

# clone repos
git clone git@github.com:Erdiko/erdiko.git -b erdiko2
git clone git@github.com:Erdiko/core.git -b erdiko2
git clone git@github.com:Erdiko/theme.git
git clone git@github.com:Erdiko/doctrine.git -b erdiko2
git clone git@github.com:Erdiko/session.git

cd erdiko
docker-compose up &

# To install packages connect to the erdiko php container and run composer install or composer update
bash -c "clear && docker exec -it erdiko_php /bin/bash"
cd /code
# cp composer-dev.json composer.json
composer update
