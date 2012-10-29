<?php
/**
 * Hello World Handler
 *
 * @author John Arroyo, john@arroyolabs.com
 */
namespace app\modules\custom\hello;

use Erdiko;

class Handler extends \erdiko\core\Handler
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

		// Add view data
		$this->setBodyTitle('Hello World');
		$this->setBodyContent("Welcome to Erdiko.");
		// Set the view template
		$this->setView('/home.php');
		// $this->addBlock();

		// Add meta tags
		$this->addMeta('This is Erdiko\'s hello world.', 'description');
		// Add page title
		$this->setPageTitle('Home');
	}

	public function aboutAction($arguments = null)
	{
		$this->setBodyTitle('About Us');
		$this->setBodyContent('Erdiko Framework.  <a href="https://github.com/arroyo/Erdiko">https://github.com/arroyo/Erdiko</a>');

		// Add page title
		$this->setPageTitle('About Us');
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
		$this->setBodyTitle('Example Mark-Up');
		$this->setBodyContent( $this->getView(null, 'pages/markup.php') );

		// Add page title
		$this->setPageTitle('Example CSS Mark-Up');
	}

	public function twocolumnAction($arguments = null)
	{
		$this->setBodyTitle( '2 Column Layout Page' );
		$this->setBodyContent( '2 column layout example' );
		$this->setLayoutColumns(2);

		// Add page title
		$this->setPageTitle('2 Column Page');
	}

	public function threecolumnAction($arguments = null)
	{
		$this->setBodyTitle( '3 Column Layout Page' );
		$this->setBodyContent( '3 column layout example' );
		$this->setLayoutColumns(3);

		// Add page title
		$this->setPageTitle('3 Column Page');
	}

}