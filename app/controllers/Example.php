<?php
/**
 * Examples Controller
 * Multiple examples of how you can use erdiko.  It includes some simple use cases.
 *
 * @category 	app
 * @package   	Example
 * @copyright	Copyright (c) 2014, Arroyo Labs, www.arroyolabs.com
 * @author 		John Arroyo, john@arroyolabs.com
 */
namespace app\controllers;

use Erdiko;
use erdiko\core\Config;

/**
 * Example Controller Class
 */
class Example extends \erdiko\core\Controller
{
	/** Before */
	public function _before()
	{
		$this->setThemeName('bootstrap');
		$this->prepareTheme();
	}

	/** Get Hello */
	public function getHello()
	{
		$this->setTitle('Hello World');
		$this->setContent("Hello World");
	}

	/**
	 * Get
	 *
	 * @param mixed $var
	 * @return mixed
	 */
	public function get($var = null)
	{
		// error_log("var: $var");
		if(!empty($var))
		{
			// load action based off of naming conventions
			return $this->_autoaction($var, 'get');

		} else {
			return $this->getIndex();
		}
	}

	/**
	 * Homepage Action (index)
	 */
	public function getIndex()
	{	
		// Add page data
		$this->setTitle('Examples');
		$this->addView('examples/index');
	}

	/**
	 * Get baseline, the simplest page around town
	 */
	public function getBaseline()
	{
		$this->setContent( "The simplest page possible" );
	}

	/**
	 * Get full page
	 */
	public function getFullpage()
	{
		$this->setThemeTemplate('fullpage');
		$this->setContent( "This is a fullpage layout (sans header/footer)" );
	}

	/**
	 * Get set view
	 */
	public function getSetview()
	{
		$this->setTitle('Example: Page with a single view');
		$this->addView('examples/setview');
	}

	/**
	 * Get multiple views
	 */
	public function getSetmultipleviews()
	{
		$this->setTitle('Example: Page with multiple views');

		// Include multiple views directly
		$content = $this->getView('examples/one');
		$content .= $this->getView('examples/two');
		$content .= $this->getView('examples/three');

		$this->setContent( $content );
	}

	/**
	 * Get multiple views at
	 */
	public function getSetmultipleviewsAlt()
	{
		$this->setTitle('Example: Page with multiple views (alt)');

		// Add multiple views using api (better approach)
		$this->addView('examples/one');
		$this->addView('examples/two');
		$this->addView('examples/three');
	}

	/**
	 * Get view2
	 */
	public function getSetview2()
	{
		// Include multiple views indirectly 
		$page = array(
			'content' => array(
				'view1' => $this->getView('examples/one'),
				'view2' => $this->getView('examples/two'),
				'view3' => $this->getView('examples/three')
				)
			);

		$this->setTitle('Example: Multiple views take 2');		
		$this->addView('examples/setview2', $page);
	}

	/**
	 * Slideshow Action 
	 */
	public function getCarousel()
	{
		// Add page data
		$this->setTitle('Example: Carousel');
		$this->addView('examples/carousel');

		// Inject the carousel js code
		$this->getResponse()->getTheme()->addJs('/themes/bootstrap/js/carousel.js');
	}

	/**
	 * Get php info
	 */
	public function getPhpinfo()
	{
		phpinfo();
		exit;
	}

	/**
	 * Get Mark Up
	 *
	 * @usage This is an alternate way to add page content data
	 * You can load a view directly into the content.
	 * This is not the preferred way to add content.
	 * Use the addView() method or a Layout when possible.
	 */
	public function getMarkup()
	{
		$this->setTitle('Example Mark-Up');
		$this->setContent( $this->getView('examples/markup') );
	}

	/**
	 * Get two column
	 */
	public function getTwocolumn()
	{
		// Set columns directly using a layout
		$columns = array(
			'one' => $this->getView('examples/one'),
			'two' => $this->getView('examples/two') . $this->getView('examples/three')
			);
		
		$this->setTitle('Example: 2 Column Layout Page');
		$this->setContent( $this->getLayout('2column', $columns) );
	}

	/**
	 * Get three column
	 */
	public function getThreecolumn()
	{
		// Set each column using a layout
		$columns = array(
			'one' => $this->getView('examples/one'),
			'two' => $this->getView('examples/two'),
			'three' => $this->getView('examples/three')
			);
		
		$this->setTitle('Example: 3 Column Layout Page');
		$this->setContent( $this->getLayout('3column', $columns) );
	}

	/**
	 * Get grid
	 */
	public function getGrid()
	{
		$data = array(
			'columns' => 4,
			'count' => 12
			);
		
		$this->setTitle('Example: Grid');
		$this->setContent( $this->getLayout('grid/default', $data) );
	}
}
