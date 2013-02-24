<?php
/**
 * CMS Handler
 *
 * @category app
 * @package cms
 * @copyright Copyright (c) 2012, Arroyo Labs, www.arroyolabs.com
 * @author John Arroyo, john@arroyolabs.com
 */
namespace app\modules\custom\cms;

use Erdiko;
use \app\modules\custom\cms\models\Cms;

class Handler extends \erdiko\core\Handler
{
	/**
	 * Homepage Action (index)
	 * @params array $arguments
	 */
	public function indexAction($arguments = null)
	{
		$this->setPageTitle("Home");
		$this->setBodyTitle("Home");
		$this->setBodyContent("This is the home page.");
		
		/*
		$cms = new Cms;
		$page = $cms->getNode('home');
		$this->setBodyTitle($this->getTitle($page));
		$this->setBodyContent($this->getBody($page));
		$this->setPageTitle($this->getPageTitle($page));
		*/

		// Add meta tags
		// $this->addMeta('This is Erdiko\'s hello world.', 'description');

		$this->setLayoutColumns(1);
	}

	/**
	 * Interpret any other general action request as a CMS page
	 * Look it up in drupal and display accordingly
	 */
	public function __call($name, $arguments)
	{
		$params = preg_split('/Action/', $name);
		// error_log("params: ". print_r($params, true));

		if(!empty($params[0]))
		{
			$node = $this->_getCmsPage($params[0]);
		}
		// @todo need to add exception handling here for missing pages, 404
	}

	/**
	 * Load a specific url key and render the page on the front-end
	 */
	private function _getCmsPage($urlKey)
	{
		$cms = new Cms;
		$page = $cms->getNode($urlKey);

		// Add view data
		$this->setBodyTitle($this->getTitle($page));
		$this->setBodyContent($this->getBody($page));

		// Add page title
		$this->setPageTitle($this->getPageTitle($page));

		// Add meta tags
		// $this->addMeta('This is Erdiko\'s hello world.', 'description');

		$this->setLayoutColumns(1);
	}

	/* -- Node Functions -- */
	
	/**
	 *
	 */
	protected function getTitle($node)
	{
		return $node->title;
	}

	/**
	 *
	 */
	protected function getPageTitle($node)
	{
		return $node->title;
	}

	/**
	 *
	 */
	protected function getBody($node, $type='safe_value')
	{
		return $node->body['und'][0][$type];
	}

}