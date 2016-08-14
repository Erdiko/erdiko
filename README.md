Erdiko
=======

[![Package version](https://img.shields.io/packagist/v/erdiko/erdiko.svg?style=flat-square)](https://packagist.org/packages/erdiko/erdiko)

**Erdiko is Enterprise Glue**

Erdiko is an MVC micro framework or better yet, an enterprise framework for APIs, lean front-ends and mash-ups.

Get work done without the bloat!

http://erdiko.org/


Installation
------------

We recommend installing using composer.  At the commandline run,

	composer create erdiko/erdiko [your-app-name]

***via git & composer***

If you prefer to install yourself you can clone erdiko from github and run "composer install" in the root folder.

1. git clone git@github.com:ArroyoLabs/erdiko.git
2. cd erdiko
3. composer install

***Server***

Now that you have the latest code, set up an apache vhost to the webroot which is located at /public/

In general, files that are downloaded in the browser go in the /public folder while application code goes in the /app folder.  Erdiko packages are located in the /vendor/erdiko/ folder.


Docker
------

If you want to run your new site using docker use our bundled container scripts by running docker-compose in the docker folder.

	cd docker

	docker-compose up -d


Documentation
-------------

See our full documentation at http://erdiko.org/


Vision
------

Erdiko wants to make your php development easier. If you need a lightweight MVC framework then this is the tool for you. Our goal is to offer a clean platform to create sites optimized for mobile devices, APIs and multiple browsers.

Erdiko can act as a mash-up or middleware framework too, hence the name 'Erdiko' which means 'middle' in the Basque language (Euskara). Use Erdiko if you need to mash-up multiple components, applications or even full frameworks. Combine things like Symfony Components, Drupal, Magento, WordPress, and Zend into a unified application.


Security 
--------

If you discover any security vulnerabilities within Erdiko, please create a github issue and send an e-mail to John Arroyo at john@arroyolabs.com. Security is top concern and all vulnerabilities will be quickly addressed.


Notes
-----

We value feedback and would love to hear your thoughts about the architecture and ease of use of this framework.  There are a lot of possibilities for Erdiko, we value your ideas and thoughts about where to take this codebase.


Upgrades
--------

If you are upgrading from version 0.9.0 or earier than you need to adjust the configs in app/config folder.  The structure has changed slightly.  Move app/config/application/default.json to app/config/default/application.json and app/config/application/routes.json to app/config/default/routes.json.  Take a look at the latest configs in this repo and make sure they adhere to the new structure.


Team
----

**Active Contributors**

    * John Arroyo
    * Andy Armstrong
    * Leo Daidone

* If you want to help, please do, we'd love more brains and clever code!  Make your enhancements and do a pull request.  If you want to get to even more involved please contact us!

**Who is behind Erdiko?**

	Erdiko was developed by Arroyo Labs, [http://arroyolabs.com](http://arroyolabs.com).
