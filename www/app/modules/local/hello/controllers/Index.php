<?php
/**
 * Hello World Index Controller
 * This is an example of how you can use erdiko.  It includes some simple use cases.
 *
 * @category 	app
 * @package   	hello
 * @copyright	Copyright (c) 2012, Arroyo Labs, www.arroyolabs.com
 * @author 		John Arroyo, john@arroyolabs.com
 */
namespace app\modules\local\hello\controllers;

use Erdiko;
use erdiko\core\Config;

class Index extends \erdiko\core\Controller
{
	/**
	 * Homepage Action (index)
	 * @params array $arguments
	 */
	public function indexAction($arguments = null)
	{
		// load js resources
		// $this->addJs('/app/contexts/default/js/jquery.orbit.js');
		// $this->addJs('/app/contexts/default/js/orbit.js');

		// Add page data
		$this->setTitle('Hello World');
		$this->setBodyContent("Welcome to Erdiko.");

		// Add meta tags
		$this->addMeta('This is Erdiko\'s hello world.', 'description');

		// Add Extra js
		$this->addJs('/themes/bootstrap/js/home.js');
	}

	public function aboutAction($arguments = null)
	{
		$this->setTitle('About Us');
		$this->setBodyContent('Erdiko Framework.  <a href="https://github.com/arroyo/Erdiko">https://github.com/arroyo/Erdiko</a>');
	}

	public function onecolumnAction($arguments = null)
	{
		/*
		This is an alternate way to add data
		You can specify title and content in a data array and set the whole array
		instead of using the setBodyTitle() and setPageContent() methods
		*/

		// Set up the view data
		$data = array(
			'content' => '1 column layout example',
			'title' => '1 Column Layout Page'
			);
		$this->setData($data);

		// Add page title
		$this->setPageTitle('1 Column Page');
		// Set layout columns
		$this->setLayoutColumns(1);
	}

	public function markupAction($arguments = null)
	{
		/*
			This is an alternate way to add page content data
			You can load a view directly into the content.
			This is not the preferred way to add content.
			Use the setView() method when possible.
		*/
		$this->setTitle('Example Mark-Up');
		$this->setBodyContent( $this->getView(null, 'hello/markup.php') );

		// Add page title
		$this->setTitle('Example CSS Mark-Up');
	}

	public function twocolumnAction($arguments = null)
	{
		$this->setTitle( '2 Column Layout Page' );
		$this->setBodyContent( '2 column layout example' );
		$this->setLayoutColumns(2);
		$this->setSidebar('left', 'This is the left side content...');

		// Add page title
		$this->setPageTitle('2 Column Page');
	}

	public function threecolumnAction($arguments = null)
	{
		$this->setTitle( '3 Column Layout Page' );
		$this->setBodyContent( '3 column layout example' );
		$this->setLayoutColumns(3);
		$this->setSidebar('left', 'This is the left side content...');
		$this->setSidebar('right', 'This is the right side content...');

		// Add page title
		$this->setPageTitle('3 Column Page');
	}

	public function gridAction()
	{
		// Js Base
		$this->setTitle('Grid');

		// Data
		$data = array(
			'columns' => 4, 
			'count' => 12, 
			'items' => array()
			);

		$this->setLayoutData($data);
		$this->setLayout('/grid/default.php');
	}

	/**
	 * Config Action
	 * @params array $arguments
	 */
	public function configAction($arguments = null)
	{
		// Add title
		$this->setTitle('Config');
		
		// Add meta tags
		$this->addMeta('Erdiko config settings', 'description');

		$config = Config::getConfig();
		Config::getConfig(); // testing the singleton
		$context = $config->getContext(); // Get the context config settings for display
		$theme = $config->getTheme();

		// This is just for debugging purposes.  Best practice is to use view templates/blocks
		$body = "Here are the config settings.<br/>".
			"<h3>Context: </h3><pre>".print_r($context, true)."</pre>".
			"<h3>Theme: </h3><pre>".print_r($theme, true)."</pre>";

		$this->setBodyContent($body);
	}

	/**
	 * Homepage Action (index)
	 * @params array $arguments
	 */
	public function exceptionAction($arguments = null)
	{
		// Add page data
		$this->setTitle('Page Exception');
		$this->setBodyContent("Welcome to Erdiko.");

		// Add meta tags
		$this->addMeta('This is an exception.', 'description');

		throw new \Exception("This is the Exception Text.");
	}
}
