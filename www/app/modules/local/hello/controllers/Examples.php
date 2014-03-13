<?php
/**
 * Examples Controller
 * Multiple examples of how you can use erdiko.  It includes some simple use cases.
 *
 * @category 	app
 * @package   	hello
 * @copyright	Copyright (c) 2014, Arroyo Labs, www.arroyolabs.com
 * @author 		John Arroyo, john@arroyolabs.com
 */
namespace app\modules\local\hello\controllers;

use Erdiko;
use erdiko\core\Config;

class Examples extends \erdiko\core\Controller
{
	/**
	 * Homepage Action (index)
	 * @params array $arguments
	 */
	public function indexAction($arguments = null)
	{
		// Add page data
		$this->setTitle('Examples');
		$this->setView('examples/index.php');
	}

	public function setviewAction($arguments = null)
	{
		$this->setTitle('Example: Page with a single view');
		$this->setView('examples/setview.php');
	}

	public function setbodycontentAction($arguments = null)
	{
		$this->setTitle('Example: Page with multiple views');

		// Include multiple views directly
		$content = $this->getView(null, 'examples/one.php');
		$content .= $this->getView(null, 'examples/two.php');
		$content .= $this->getView(null, 'examples/three.php');

		$this->setBodyContent( $content );
	}

	public function setview2Action($arguments = null)
	{
		// Include multiple views indirectly
		$data = array(
			'view1' => $this->getView(null, 'examples/one.php'),
			'view2' => $this->getView(null, 'examples/two.php'),
			'view3' => $this->getView(null, 'examples/three.php')
			);

		$this->setData($data);
		$this->setTitle('Example: Page with multiple views');
		$this->setView('examples/setview2.php');
	}

	public function twocolumnAction($arguments = null)
	{
		$this->setLayoutColumns(3);
		
		$right = $this->getView(null, 'examples/one.php');
		$right .= $this->getView(null, 'examples/two.php');
		$right .= $this->getView(null, 'examples/three.php');

		// Set sidebars directly
		$sidebars = array(
			'right' => array(
				'content' => $right,
				'view' => 'sidebars/default.php')
			);
		$this->setSidebars($sidebars);

		$this->setBodyContent( '2 column layout example' );
		$this->setPageTitle('2 Column Page');
		$this->setBodyTitle( 'Example: Complex 2 Column' );
	}

	public function threecolumnAction($arguments = null)
	{
		$this->setLayoutColumns(3);
		
		$left = $this->getView(null, 'examples/one.php');
		$left .= $this->getView(null, 'examples/two.php');
		$left .= $this->getView(null, 'examples/three.php');

		// Set sidebars directly
		$sidebars = array(
			'left' => array('content' => $left),
			'right' => array(
				'content' => 'right sidebar',
				'view' => 'sidebars/default.php')
			);
		$this->setSidebars($sidebars);

		$this->setBodyContent( '3 column layout example' );

		$this->setPageTitle('3 Column Page');
		$this->setBodyTitle( 'Example: Complex 3 Column' );
	}

	/**
	 * Slideshow Action 
	 * @params array $arguments
	 */
	public function carouselAction($arguments = null)
	{
		// Add page data
		$this->setTitle('Carousel');
		$this->setView('pages/carousel.php');

		// Add Extra js
		$this->addJs('/themes/bootstrap/js/carousel.js');
	}

	public function phpinfoAction()
	{
		phpinfo();
		exit;
		
		// Add page data
		$this->setTitle('PHP Info');
		$this->setBodyContent("booyah");
	}
}