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

		// Set up the view data
		$data = array(
			'title' => 'Hello World',
			'content' => "Welcome to Erdiko.",
			);

		// Add meta tags
		$this->addMeta('This is Erdiko\'s hello world.', 'description');
		// Add page title
		$this->addPageTitle('Home');
		// Get rendered view
		$html = $this->getView($data, 'home.php');

		/*	
			$this->setData();
			$this->addBlock();
			$this->setView();
			$this->render();
		*/

		return $html;
	}

	public function aboutAction($arguments = null)
	{
		// Set up the view data
		$data = array(
			'content' => 'Erdiko Framework.  <a href="https://github.com/arroyo/Erdiko">https://github.com/arroyo/Erdiko</a>'
			);
		// Add page title
		$this->addPageTitle('About Us');
		// Get a view
		$html = $this->getView($data, 'pages/about.php');

		return $html;
	}

	public function markupAction($arguments = null)
	{
		// Set up the view data
		$data = array(
			'title' => 'Example Mark-Up',
			'content' => 'See examples of how various tags render.',
			);
		// Add page title
		$this->addPageTitle('Example CSS Mark-Up');
		// Get a view
		$html = $this->getView($data, 'pages/markup.php');
		// $html = $this->embedView('pages/markup.php');

		return $html;
	}

	public function onecolumnAction($arguments = null)
	{
		// Set up the view data
		$data = array(
			'content' => '1 Column Page',
			'title' => '1 Column Page'
			);
		// Add page title
		$this->addPageTitle('1 Column Page');
		// Get a view
		$html = $this->getView($data, 'page.php');

		return $html;
	}

}
