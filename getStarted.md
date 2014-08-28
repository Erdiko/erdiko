---
layout: getStarted
title: GetStarted 
header: GetStarted
---
{% include JB/setup %}

<div id = "Learn_01"></div>

## System requirements
---

#####Webserver
* Apache with mod rewrite (or equivalent server)

#####PHP
* PHP 5.3 or higher.

<div id = "download_link"></div>
<div id = "Learn_0"></div>

## Quick Installation
---

####Via Composer

The Eridko framework utilizes Composer for installation and dependency management. If you haven not install Composer, start by installing Composer.

After you installed Composer, you can run the following command in your terminal:

	composer create-project erdiko/erdiko project-name

This command will download and install a fresh copy of Erdiko in a new project-name folder within your current directory.


####Via Github

* Step #1: [Download Erdiko](#download)
* Step #2: [Setup web environment](#Learn_2)


<div id = "download"></div>

## Download Erdiko
---
To download Erdiko from our Git repository, enter the following command in command prompt:

	git clone https://github.com/arroyolabs/erdiko

It will clone our Git repository to your local machince. Then, go to the Erdiko root folder and install Erdiko using Composer.

	composer install


<div id = "Learn_2"></div>

## Setup web environment
---
1. Open the config file of your web server

2. Change the webroot to `[your computer path]/erdiko/public`

3. Save changes and restart your web server.

4. Type http://localhost into your browser

5. If you can see the Hello world page, you have successfully installed Erdiko!

<div class="alert alert-dismissable alert-warning">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <h4>Warning!</h4>
  <p>If you cannot open the Hello world page, go back to the config file of your web server to check if the port is 80.  If the port is other than 80, you need to specify the port in Step 4. For example, if you port is 8080, the URL link will be http://localhost:8080 .</p>
</div>

<div class="alert alert-dismissable alert-info">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>Heads up!</strong>
	<p>
		All of your server side application code should go in the /app folder while any js file, css file or asset should go in the /public folder.
	</p>
	<p>Theme/view files go in the /www/public folder while application code goes in the /www/app/ folder. Do not modify files in /vendor/erdiko/* if you want to maintain an easy upgrade path with Erdiko.</p>
</div>


<div id = "Learn_3"></div>

## Create add your first page
---
1. We will first need to add a tab to the menu.  To do so, open the main config file located at `Erdiko/www/app/config/contexts/default.json`

2. Find the menu section and insert the following code.

<script src="https://gist.github.com/colemantung/77e795c36662e2c5b8a4.js"></script>

3. After inserting the code above, the menu section should look like this.

<script src="https://gist.github.com/colemantung/070eb875dc5fe5779932.js"></script>

4. Save the changes of the file, and open the site in your browser.
   You should be able to see that there is a new tab on the menu.

<div class="alert alert-dismissable alert-info">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>Heads up!</strong> When you click on the tab, it will show error.
    <p>It is normal because you have not set any contents to the page. </p>
</div>


<div id = "Learn_4"></div>

## Set content of a page
---
5. To add contents to a page, open the page config file located at `Erdiko/www/app/controllers/index.php`.

6. Add the following function inside the Index class

<script src="https://gist.github.com/colemantung/c02660ab203eb97375a5.js"></script>

7. Save the changes and open the site in your browser.
   You should be able to see your first page.

<div class="alert alert-dismissable alert-success">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>Well done!</strong>
  <p>You successfully create your first page using Erdiko.</p>
</div>

<div class="alert alert-dismissable alert-info">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>Heads up!</strong>
	<p>If you want to create a full page, you can add the following line in the myfirstpageAction function. <br>
	<p align="center">$this->setTemplate('fullpage');</p>
	</p>
</div>


<div id = "Learn_5"></div>

## Use PHP for a page
---
1. Open the corresponding .php file under the folder `Erdiko/www/app/controllers/`.

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

## Use Javacript for a page
---
1. Open the corresponding .js file under the folder `Erdiko/www/app/controllers/`.

2. Inside the .js file, find the function of the page you want to use Javascript.

3. Insert the following code:

		$this->addJs('[Path of the .js file]');

<div class="alert alert-dismissable alert-info">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>Heads up!</strong> The root of the path is `Erdiko/www/public/`.<br>
	For example, if you want to include the .js file located at `Erdiko/www/public/themes/bootstrap/js/test.js`,
	the path will be `/themes/bootstrap/js/test.js`.
</div>


<div id = "Learn_7"></div>

## Add a BMI calculator page using Javascript
---
1. 	Open the main config file located at `Erdiko/www/app/config/contexts/default.json`

2. 	Find the menu section and insert the following code.

		,
         {
            "href":"/examples/bmi",
            "title":"BMI"
         }
3. 	Open the routing config file located at `Erdiko/www/app/config/application.json`.
	We can see that sites located at `/` will be routed to the controller Index and sites located at `/examples/` will be routed to the controller Example.

4.  Open the controller Example located at `Erdiko/www/app/controllers/Examples.php`

5.  Add the following function inside the Examples class

		public function bmiAction()
		{
			$this->setTitles('BMI Example');
			$this->setView('/examples/bmi.php');

			$this->addJs('/themes/hello/js/example.js'); //Link JS to the page
		}

6.  Create a file called `bmi.php` under `Erdiko/www/app/views/examples/`

7.  Open the bmi.php and add the following code:

<script src="https://gist.github.com/colemantung/3cff36bbc3ac250db19f.js"></script> 

8.  Create `example.js` under the folder `Erdiko/www/public/themes/hello/js/`

9.  Paste the following code to `example.js`

<script src="https://gist.github.com/colemantung/6fb653cd88415e427a14.js"></script>

10.  Save all changes, and open a web brower.

11.  Go to localhost, click the BMI tab on the menu, and then you should see [this](./assets/themes/bootstrap-3.1.1/img/getStarted/BMI_V1_1.png).



<div id = "Learn_8"></div>

## Add a BMI calculator page using new route
---
1. 	Open the main config file located at `Erdiko/www/app/config/contexts/default.json`

2. 	Find the menu section and insert the following code.

		,
         {
            "href":"/Calculator/bmi_version2",
            "title":"BMI"
         }

3. 	Open the routing config file located at `Erdiko/www/app/config/application.json`.
	Add a new rule to the route.

		["Calculator/([a-zA-Z0-9_\-/]+)", "\app\controllers\Calculator"],

4.  Then, we will need to create a new controller for the new route.
	To create a new controller, create `Calculator.php` under the folder `Erdiko/www/app/controllers/`

5.  Paste the following code inside the `Calculator.php`

<script src="https://gist.github.com/colemantung/2154a0c0d36b96529cc7.js"></script>

6.  Create a file called `bmi.php` under `Erdiko/www/app/views/examples/`

7.  Open the bmi.php and add the following code:

<script src="https://gist.github.com/colemantung/c45003580e391cff6239.js"></script>

8.  Create a file called `bmi_post.php` under `Erdiko/www/app/views/examples/`

9.  Open the bmi_post.php and add the following code:

<script src="https://gist.github.com/colemantung/ffffdf39b78d650a4734.js"></script>

10.  Save all changes, and open the site in your web brower.

11.  Click the BMI tab on the menu, and then you should see the following results.

	 [BMI Version 2](./assets/themes/bootstrap-3.1.1/img/getStarted/BMI_V2_1.png)
	
	 [BMI Version 2 Result](./assets/themes/bootstrap-3.1.1/img/getStarted/BMI_V2_2.png)



