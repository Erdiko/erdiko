#!/bin/sh

# Run unit tests inside of docker
cd /code/vendor/erdiko/core/tests/
phpunit AllTests
