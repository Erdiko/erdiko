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
			'content' => "Hello World."
			);

		// Add meta tags
		$this->addMeta('This is Erdiko\'s hello world.', 'description');
		// Add page title
		$this->addPageTitle('Home');
		// Get a view
		$html = $this->getView('home.php', $data);

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
		$html = $this->getView('pages/about.php', $data);

		return $html;
	}

}
