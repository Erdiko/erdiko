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

2. Change the webroot to `[Your computer path]/Erdiko/www/public`

3. Open a web brower and go to localhost

4. If you can see the Hello world page, it works!

<div class="alert alert-dismissable alert-info">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>Heads up!</strong> Theme/view files go in the /www/public folder while application code goes in the /www/app/ folder. Do not modify files outside of app and public folder if you want to maintain an easy upgrade path with Erdiko.
</div>

<div id = "Learn_3"></div>

## Create add your first page

1. We will first need to add a tab to the menu. To do so, open the main config file located at `Erdiko/www/app/config/contexts/default.json`

2. Find the menu session and insert the following code.

		,
	         {
	            "href":"/myfirstpage",
	            "title":"My First Page"
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
	           		 "href":"/myfirstpage",
	            	"title":"My First Page"
	        	 }
		      ],

4. Save the changes of the file, and open the site in your browser.
   You should be able to see that there is a new tab on the menu.

    !!!!!!!!img here!!!!!!!

<div class="alert alert-dismissable alert-info">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>Heads up!</strong> When you click on the tab, it will show error.
   It is normal because you have not set any contents to the page.
</div>


## Set content of a page

5. To add contents to a page, Open the page config file located at `www/app/controllers/index.php`.

6. Add the following function inside the Index class

		public function myfirstpageAction()
		{
			$this->setTitles('My First page');
			$this->setBodyContent("This is my first page");
		}

7. Save the changes and open the site in your browser.
   You should be able to see your first page.

   !!!!!!!!img here!!!!!!!

<div class="alert alert-dismissable alert-info">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>Heads up!</strong> If you want to create a full page, you can add the following line in the myfirstpageAction function. <br>
	<p align="center">$this->setTemplate('fullpage');</p>
</div>


<div id = "Learn_4"></div>

## Use Javacript for a page


1. Open the corresponding .php file under the folder Erdiko/www/app/controllers/.

2. Inside the .php file, find the function of the page you want to use Javascript.

3. Insert the following code:

	$this->addJs('[Path of the .js file]');

<div class="alert alert-dismissable alert-info">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>Heads up!</strong> The root of the path is `Erdiko/www/public/`.<br>
	For example, if you want to include the .js file located at `Erdiko/www/public/themes/bootstrap/js/test.js`,
	the path will be `/themes/bootstrap/js/test.js`.
</div>


<div id = "Learn_5"></div>

## File Structure


## Use PHP for a page


1. Open the corresponding .php file under the folder Erdiko/www/app/controllers/.

2. Inside the .php file, find the function of the page you want to use Javascript.

3. Insert the following code:

	$this->setView('[Path of the .php file]');

<div class="alert alert-dismissable alert-info">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>Heads up!</strong> The root of the path is `Erdiko/tree/master/www/app/views`.<br>
	For example, if you want to use the php file located at `EErdiko/tree/master/www/app/views/example/test.php`,
	the path will be `/example/test.php`.
</div>


<div id = "Learn_6"></div>

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

