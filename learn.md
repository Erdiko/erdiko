---
layout: learn
title: Learn 
header: Learn
---
{% include JB/setup %}
<div id = "Learn_1"></div>

## Download Erdiko

To download Erdiko from Git, enter the follow command in the command prompt:

	git clone https://github.com/arroyo/Erdiko

<div class="alert alert-dismissable alert-warning">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <h4>Warning!</h4>
  <p>If you do not have a web server installed, you can install <a href="http://www.apache.org" class="alert-link">Apache</a>, LAMP, or MAMP.</p>
</div>

<div id = "Learn_2"></div>

## Setup web environment

1. Open the configuration file of your web server

2. Change the webroot to [Your computer path]/Erdiko/www/public

3. Open a web brower and go to localhost

4. If you can see the Hello world page, it works!

<div class="alert alert-dismissable alert-info">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>Heads up!</strong> Theme/view files go in the /www/public folder while application code goes in the /www/app/ folder. Do not modify files outside of app and public folder if you want to maintain an easy upgrade path with Erdiko.
</div>

<div id = "Learn_3"></div>

## Create add a Hello World page to the framework

1. We will first need to add a tab to the menu. To do so, open the main config file located at Erdiko/www/app/config/contexts/default.json

2. Find the menu session and insert the following code.

		,
	         {
	            "href":"/helloworld",
	            "title":"HelloWorld"
	         }

3. After inserting the code above, the menu session should look like this.

		"menu":{
		      "main":[
		         {
		            "href":"/examples/index",
		            "title":"Examples"
		         },
		         {
		            "href":"/markup",
		            "title":"Mark-Up"
		         },
		         {
		            "href":"/grid",
		            "title":"Grid"
		         },
		         {
		            "href":"/onecolumn",
		            "title":"1 Column Layout"
		         },
		         {
		            "href":"/twocolumn",
		            "title":"2 Column Layout"
		         },
		         {
		            "href":"/threecolumn",
		            "title":"3 Column Layout"
		         },
		         {
		            "href":"/helloworld",
		            "title":"HelloWorld"
		         }
		      ],

4. Open the page config file located at www/app/controllers/index.php

5. 

<div id = "Learn_4"></div>

## File Structure


####Erdiko/www/app/config/contexts/default.json
This is the configuration file of the main framework.

####Erdiko/www/app/config/application.json
This is the configuration file of the routing.

####Erdiko/www/app/controllers/Index.php
This is the default controller.

####Erdiko/www/app/view/
This is the folder for view.

####Erdiko/www/public/theme
This folder stores the themes.

####Erdiko/www/public/theme/hello
This is the defualt theme



<div id = "Learn_5"></div>

## Update Author Attributes

In `_config.yml` remember to specify your own data:
    
    title : My Blog =)
    
    author :
      name : Name Lastname
      email : blah@email.test
      github : username
      twitter : username

The theme should reference these variables whenever needed.


<div id = "Learn_6"></div>

## Update Author Attributes

In `_config.yml` remember to specify your own data:
    
    title : My Blog =)
    
    author :
      name : Name Lastname
      email : blah@email.test
      github : username
      twitter : username

The theme should reference these variables whenever needed.


<div id = "Learn_7"></div>

## Update Author Attributes

In `_config.yml` remember to specify your own data:
    
    title : My Blog =)
    
    author :
      name : Name Lastname
      email : blah@email.test
      github : username
      twitter : username

The theme should reference these variables whenever needed.


<div id = "Learn_8"></div>

## Update Author Attributes

In `_config.yml` remember to specify your own data:
    
    title : My Blog =)
    
    author :
      name : Name Lastname
      email : blah@email.test
      github : username
      twitter : username

The theme should reference these variables whenever needed.


<div id = "Learn_9"></div>

## Update Author Attributes

In `_config.yml` remember to specify your own data:
    
    title : My Blog =)
    
    author :
      name : Name Lastname
      email : blah@email.test
      github : username
      twitter : username

The theme should reference these variables whenever needed.## Update Author Attributes


<div id = "Learn_10"></div>

## Update Author Attributes

In `_config.yml` remember to specify your own data:
    
    title : My Blog =)
    
    author :
      name : Name Lastname
      email : blah@email.test
      github : username
      twitter : username

The theme should reference these variables whenever needed.

