Contexts
========

Contexts are central to working with erdiko. All configuration and bootstrap settings are part of the context.  

3 key parts to any erdiko application

1. Contexts
2. App
3. Vendor

Contexts allow you to tune and configure your app based on the use case.  It is also a way to handle a typical use case, like multi-site


Default config files
--------------------

contexts/default/

config/application.json

That is the default context. A context here is a website, api, etc. In order to support multi-site we have a simple mechanism for context switching.


Creating a new context
----------------------

To create a new context you will need to create new folder under config with the name of that context and place at a minimum a new routes.json and application.json in it.  You can copy over the ones in default.

	e.g. for a new context called 'site2'

	config/site2/application.json
	config/site2/routes.json

Help
====

default/routes.json

	* Defines site wide routes
