#!/bin/sh

set -e

# Run phpunit tests in relevant container(s)
# If release branch do a full regression against php versions
# @note perhaps we should do this for master as well
if [ "$CIRCLE_BRANCH" == "release" ]; then

    docker exec -it erdiko_phpfpm_7.1 /code/vendor/erdiko/core/.circleci/scripts/phpunit.sh
    docker exec -it erdiko_phpfpm_7.0 /code/vendor/erdiko/core/.circleci/scripts/phpunit.sh
    docker exec -it erdiko_phpfpm_5.6 /code/vendor/erdiko/core/.circleci/scripts/phpunit.sh
    docker exec -it erdiko_phpfpm_5.5 /code/vendor/erdiko/core/.circleci/scripts/phpunit.sh
    docker exec -it erdiko_phpfpm_5.4 /code/vendor/erdiko/core/.circleci/scripts/phpunit.sh

# Else run the current branch's tests against the offical erdiko_php image
else

    docker exec -it erdiko_php /code/vendor/erdiko/core/.circleci/scripts/phpunit.sh

fi
