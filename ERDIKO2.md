# Erdiko 2 Development

## Quick Installation

Create a working folder, e.g erdiko2, and then run the install script.

```
mkdir erdiko2
cd erdiko2
curl -s https://raw.githubusercontent.com/Erdiko/erdiko/erdiko2/.circleci/scripts/build.sh | bash
```

## Manual Installation

### Clone all the repositories

```
git clone git@github.com:Erdiko/erdiko.git -b erdiko2
git clone git@github.com:Erdiko/core.git -b erdiko2
git clone git@github.com:Erdiko/theme.git
git clone git@github.com:Erdiko/doctrine.git -b erdiko2
git clone git@github.com:Erdiko/session.git -b erdiko2

cd erdiko
docker-compose up &
```

### Install the packages

To install packages connect to the erdiko php container and run composer install or composer update

```
bash -c "clear && docker exec -it erdiko_php /bin/bash"
cd /code
composer update
```

@note You may see a warning with composer since you are running as root, but it's ok to ignore it
