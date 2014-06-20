---
layout: getStarted
title: GetStarted 
header: GetStarted
---
{% include JB/setup %}

<div id = "Learn_01"></div>

## System requirements
<hr>
#####Web server
* Apache, Nginx, or Microsoft IIS

#####PHP
* PHP 5.2.5 or higher (5.3 recommended).


<div class="alert alert-dismissable alert-warning">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <h4>Warning!</h4>
  <p>If you do not have a web server installed, you can install <a href="http://www.apache.org" class="alert-link">Apache</a>, LAMP (Linux), MAMP (Mac), or WAMP (Windows).</p>
</div>


<div id = "Learn_0"></div>

## Quick Installation
<hr>
* Step #1: [Download Erdiko](#Learn_1)
* Step #2: [Setup web environment](#Learn_2)


<div id = "Learn_1"></div>

## Download Erdiko
<hr>
To download Erdiko from our Git repository, enter the following command in command prompt:

	git clone https://github.com/arroyo/Erdiko

It will clone our Git repository to your local machince.


<div id = "Learn_2"></div>

## Setup web environment
<hr>
1. Open the configuration file of your web server

2. Change the webroot to `[your computer path]/Erdiko/www/public`

3. Save changes of the configuration file and restart your web server.

3. Type http://localhost into your browser

4. If you can see the Hello world page, you have successfully installed Erdiko!

<div class="alert alert-dismissable alert-warning">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <h4>Warning!</h4>
  <p>If you cannot open the Hello world page, go back to the the configuration file of the web server to check if the port number is 80.</p>
</div>

<div class="alert alert-dismissable alert-info">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>Heads up!</strong> Theme/view files go in the /www/public folder while application code goes in the /www/app/ folder. Do not modify files outside of app and public folder if you want to maintain an easy upgrade path with Erdiko.
</div>


<div id = "Learn_3"></div>

## Create add your first page
<hr>
1. We will first need to add a tab to the menu. To do so, open the main config file located at `Erdiko/www/app/config/contexts/default.json`

2. Find the menu section and insert the following code.

		,
	         {
	            "href":"/myfirstpage",
	            "title":"My First Page"
	         }

3. After inserting the code above, the menu section should look like this.

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


<div id = "Learn_4"></div>

## Set content of a page
<hr>
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

<div class="alert alert-dismissable alert-success">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>Well done!</strong> You successfully create your first page using Erdiko.
</div>

<div class="alert alert-dismissable alert-info">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>Heads up!</strong> If you want to create a full page, you can add the following line in the myfirstpageAction function. <br>
	<p align="center">$this->setTemplate('fullpage');</p>
</div>


<div id = "Learn_5"></div>

## Use PHP for a page
<hr>
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

## Use Javacript for a page
<hr>
1. Open the corresponding .js file under the folder Erdiko/www/app/controllers/.

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
<hr>
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

6.  Create a file called `bmi.php` under Erdiko/www/app/views/examples/

7.  Open the bmi.php and add the following code:

		 <h1>Body Mass Index Calculator</h1>
	    <p>Enter your height:
	        <input type="text" id="height" />
	        <select type="multiple" id="heightunits">
	            <option value="metres" selected="selected">metres</option>
	            <option value="inches">inches</option>
	        </select>
	    </p>
	    <p>Enter your weight:
	        <input type="text" id="weight" />
	        <select type="multiple" id="weightunits">
	            <option value="kg" selected="selected">kilograms</option>
	            <option value="lb">pounds</option>
	        </select>
	    </p>
	    <input type="button" value="computeBMI" onclick="computeBMI()"/>
	     <h1>Your BMI is: <span id="output">?</span></h1>

	    <h2>This means you are: value = <span id='comment'></span> </h2> 

8.  Create `example.js` under the folder `Erdiko/www/public/themes/hello/js/`

9.  Paste the following code to `example.js`

		 function computeBMI() {
		      //Obtain user inputs
		     var height = Number(document.getElementById("height").value);
		     var heightunits = document.getElementById("heightunits").value;
		     var weight = Number(document.getElementById("weight").value);
		     var weightunits = document.getElementById("weightunits").value;


		     //Convert all units to metric
		     if (heightunits == "inches") height /= 39.3700787;
		     if (weightunits == "lb") weight /= 2.20462;

		     //Perform calculation
		     var BMI = weight / Math.pow(height, 2);
		     //Display result of calculation
		document.getElementById("output").innerHTML = Math.round(BMI * 100)/100;
		     if (BMI < 18.5) document.getElementById("comment").innerHTML = "Underweight";
		     if (BMI >= 18.5 && BMI <= 25) document.getElementById("comment").innerHTML = "Normal";
		     if (BMI >= 25 && BMI <= 30) document.getElementById("comment").innerHTML = "Obese";
		     if (BMI > 30) document.getElementById("comment").innerHTML = "Overweight";
		     document.getElementById("answer").value = output;
		 }


8.  Save all changes, and open a web brower.

9.  Go to localhost, click the BMI tab on the menu, and then you should see the result.



<div id = "Learn_8"></div>

## Add a BMI calculator page using external .php and new route
<hr>
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

5.  Paste the following code inside the Calculator.php

			<?php

			namespace app\controllers;

			use Erdiko;
			use erdiko\core\Config;

			class Examples extends \erdiko\core\Controller
			{

				public function bmi_version2Action()
				{
					$this->setTitles('BMI Example');
					$this->setView('/examples/bmi.php');
				}

				public function bmi_postAction()
				{
					$this->setTitles('BMI Post');
					$this->setView('/examples/bmi_post.php');
				}
				
			}

			?>

6.  Create a file called `bmi.php` under Erdiko/www/app/views/examples/

7.  Open the bmi.php and add the following code:

		<form action ="bmi_post" method = "post">
	    Weight(kgs): <input type = "text" name = "wt">
	    Height (m) : <input type = "text" name = "ht">
	    <input type = "submit" name="sub_form">
	    
		</form>

8.  Create a file called `bmi_post.php` under Erdiko/www/app/views/examples/

9.  Open the bmi_post.php and add the following code:

		<?php
	    if(isset($_POST['sub_form'])){
	        if($_POST['wt']<= 0 ||$_POST['ht'] <= 0) die("Enter valid values.");
	        $wt = $_POST['wt'];
	        $ht = $_POST['ht'];
	        $ht = $ht * $ht;
	        $bmi =     round($wt/$ht,2);
	        if($bmi < 20)die( 'You are underweight. Your BMI is '.$bmi);
	        if($bmi >25) die ('You are overweight. Your BMI is '.$bmi);
	        echo "You weight is optimum. Your BMI is ".$bmi;
	    }
		?>


10.  Save all changes, and open a web brower.

11.  Go to localhost, click the BMI tab on the menu, and then you should see the result.



<div id = "Learn_9"></div>

## File Structure
<hr>
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

####Erdiko/www/public/theme/hello/
This is the theme of the hello page


<div id = "Learn_10"></div>

## Update Author Attributes
<hr>
In `_config.yml` remember to specify your own data:
    
    title : My Blog =)
    
    author :
      name : Name Lastname
      email : blah@email.test
      github : username
      twitter : username

The theme should reference these variables whenever needed.

