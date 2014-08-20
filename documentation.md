---
layout: documentation
title: Documentation 
header: Documentation
---
{% include JB/setup %}

<div id = "section-0"></div>
<div id = "config"></div>

## Config

The config folder is located at /app/config/

The default application config file is /app/config/application/default.json

---

<div id = "routes"></div>

## Routes

Application routes are defined in the file, /app/config/application/routes.json 
Update your app's routes in this file.

Erdiko uses the same routing conventions defined by ToroPHP (modeled after Tornado, a python framework)

E.g. To route the root of the site to the Example controller 
	"/": "\app\controllers\Example"

E.g. To route example.com/examples/token, where the token is an alpha only name used in the controller
	"examples/:alpha": "\app\controllers\Example"

For more information on routing see [Toro PHP routing](https://github.com/anandkunal/ToroPHP#routing-basics)

---

<div id = "controllers"></div>

## Controllers

The controllers are located at `app/controllers/’.

---


<div id = "views"></div>

## Views

The views are located at `app/views/’.

---

<div id = "models"></div>

## Models

The models are located at `app/models/’.

---

<div id = "hooks"></div>

## Hooks

For more hooks information see https://github.com/anandkunal/ToroPHP#torohook-callbacks

---

<div id = "about_erdiko"></div>

## About Erdiko

Erdiko wants to make your php development easier. If you need a lightweight MVC framework you have come to the right place. Our goal is to offer a clean framework to create sites optimized for mobile devices, APIs and multiple browsers.  Get work done without a lot of unneccessary plumbing to get in the way.  It is camptible with composer, which makes it easy to use with other PHP projects like Doctrine


Erdiko can act as a middleware framework, hence the name which means 'middle' in the Basque language (Euskara). Use Erdiko if you need to mash-up multiple applications/frameworks like Drupal, Magento, WordPress, and Zend into a unified application.

---

<div id = "note"></div>

## Note

The code is a work in progress, and although stable, may contain items that need more refinement. There are various production sites currently using this software yet it is best to consider it beta.

We value feedback and would love to hear your thoughts about the architecture and ease of use of this framework. There are a lot of possibilities for Erdiko, we value your ideas and thoughts about where to take this codebase.
		
---

<div id = "team"></div>

## Team

<br>

####Author
* John Arroyo - Architect, Lead Back-End / Integration engineer

<br>

####Contributors
* Coleman Tung - Back-End development, Documentation and unit testing
* Varun Brahme - Back-End development and unit testing
* Dave LaFLam - Front-End development (original theme)

<br>
		
If you want to help, please do, we'd love more code! Make your enhancements and do a pull request. If you want to get to even more involved please contact us!

---

<div id = "special_thanks"></div>

##Special Thanks

Arroyo Labs - For sponsoring development, [http://arroyolabs.com](http://arroyolabs.com)

less - dynamic stylesheet language, [http://lesscss.org](http://lesscss.org)

Toro - PHP router (micro framework), [http://toroweb.org](http://toroweb.org)


---

