Erdiko
=======

[![Package version](https://img.shields.io/packagist/v/erdiko/erdiko.svg?style=flat-square)](https://packagist.org/packages/erdiko/erdiko) [![Travis CI](https://travis-ci.org/Erdiko/erdiko.svg?branch=master)](https://travis-ci.org/Erdiko/erdiko) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Erdiko/erdiko/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Erdiko/erdiko/?branch=master) [![License](https://poser.pugx.org/erdiko/erdiko/license)](https://packagist.org/packages/erdiko/erdiko)


About Erdiko
------------

Erdiko is a micro MVC framework, or better yet, a lean framework for APIs, web apps and websites.  Erdiko is developer and start up friendly.

Take a lean approach to your next PHP project.


Learning Erdiko
---------------

See our full documentation at http://erdiko.org/


Erdiko Slim
-----------

This branch represesnts our migration of erdiko to slim.  It uses the slim skeleton as a starting point (slim/slim-skeleton).  

### Requires PHP 7

If you use the latest Erdiko PHP-FPM container from dockerhub you will have everything you need to run erdiko slim, https://hub.docker.com/r/erdiko/php-fpm/

### Docker Setup

To run your erdiko slim app clone this repo and run docker-compose in the main folder.

    docker-compose up -d


History & Resources
-------------------

The concepts and libraries for the transistion of erdiko to slim started in Summer 2016.  Lots of brainstorming and research went into this effort.  

A post last year about the move to Slim, http://blog.arroyolabs.com/2016/08/moving-to-slimphp/

Inspiration for better frameworks, http://blog.arroyolabs.com/2016/05/a-new-framework-architecture-for-2016/

Learn more about Erdiko, http://erdiko.org/

Roadmap
-------

After the initial development of erdiko slim, we will merge this repo into the main erdiko/erdiko and erdiko/core libraries.  At that point we will keep this repo up as an archive.

We hope the new framework will be ready sometime summer 2017.  Once the new framework is ready we can update all the erdiko packages to be compatible, especially [erdiko/user-admin](https://github.com/Erdiko/user-admin) and [arroyolabs/erdiko-wordpress](https://github.com/ArroyoLabs/erdiko-wordpress)


- - - Legacy README - - -

Installation
------------

We recommend installing Erdiko with [composer](here https://getcomposer.org/).  At the commandline simply run:

    composer create erdiko/erdiko [your-app-name]

Erdiko is easy to use with Nginx or Apache.  Simply set the webroot to public/default/


Docker
------

You don't need [Docker](https://www.docker.com/) to run Erdiko, but we are big fans and want to make it easy to use with Docker if you desire.

If you want to run your new site using Docker use our bundled container scripts by running docker-compose in the root of your project.

    docker-compose up -d

You will need to add erdiko.local to your etc hosts file.
    
    127.0.0.1       erdiko.local

Your dev site will now be running at http://erdiko.local/


Alternative Installation
------------------------

(Via git & docker)

This option will give you a fully working container environment and install all of the required packages.  It assumes you have both docker and docker-compose installed.

    git clone git@github.com:Erdiko/erdiko.git
    cd erdiko
    docker-compose up &
    docker exec -it erdiko_php /bin/bash
    cd /code
    composer install

See the Docker section for more information.


Vision
------

Erdiko wants to make your php development easier. If you need a lightweight MVC framework then this is the tool for you. Our goal is to offer a clean platform to create sites optimized for web applications, websites, & APIs.

Erdiko can also act as a mash-up framework too, hence the name 'erdiko' which means 'central' or 'middle' in the Basque language (Euskara). Use Erdiko if you need to mash-up multiple packages, applications or even full frameworks. Combine things like Symfony Components, Laravel Packages, Drupal, Magento, WordPress, and Zend into a unified application.


Security
--------

Security is very important to us.  If you discover any vulnerabilities within Erdiko or any of our packages, please create a github issue and send an e-mail to John Arroyo at john@arroyolabs.com. Security is top concern and all vulnerabilities will be quickly addressed.


Notes
-----

We value feedback and would love to hear your thoughts about the architecture and ease of use of this framework.  There are a lot of possibilities for Erdiko, we value your ideas and thoughts about where to take this codebase.


Upgrades
--------

If you are upgrading from version 0.9.0 or earier than you need to adjust the configs in app/config folder.  The structure has changed slightly.  Move app/config/application/default.json to app/config/default/application.json and app/config/application/routes.json to app/config/default/routes.json.  Take a look at the latest configs in this repo and make sure they adhere to the new structure.


Credits
-------

* John Arroyo
* Andy Armstrong
* Leo Daidone

[All Contributors](https://github.com/Erdiko/erdiko/graphs/contributors)

* If you want to help, please do, we'd love more brainpower!  Fork, commit your enhancements and do a pull request.  If you want to get to even more involved please contact us!


Sponsors
--------

[Arroyo Labs](http://www.arroyolabs.com/)


License
-------

Erdiko is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
