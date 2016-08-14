Default config files
====================

default/application.json

That is the default context.  A context here is a website, api, etc.  In order to support multi-site we have a simple mechanism for context switching.

Shared configs
==============

Place any config files that should be shared across contexts in the shared folder.

Creating a new context
======================

To create a new context you will need to create new folder under config with the name of that context and place at a minimum a new routes.json and application.json in it.  You can copy over the ones in default.

	e.g. for a new context called 'site2'

	config/site2/application.json
	config/site2/routes.json

Help
====

default/routes.json

	* Defines site wide routes
