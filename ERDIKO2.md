Erdiko 2
========

Installation
-----------

    git clone git@github.com:Erdiko/erdiko.git
    git clone git@github.com:Erdiko/core.git erdiko-core
    git clone git@github.com:Erdiko/theme.git

    cd erdiko
    docker-compose up &

to install packages connect to the erdiko php container and run composer install or composer update

    bash -c "clear && docker exec -it erdiko_php /bin/bash"
    cd /code
    composer update

