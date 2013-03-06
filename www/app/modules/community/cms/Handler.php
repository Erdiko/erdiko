<?php
/**
 * CMS Handler
 *
 * @category app
 * @package cms
 * @copyright Copyright (c) 2012, Arroyo Labs, www.arroyolabs.com
 * @author John Arroyo, john@arroyolabs.com
 */
namespace app\modules\community\cms;

use Erdiko;
use \app\modules\community\cms\models\Cms;
use \app\modules\community\cms\models\User;

class Handler extends \erdiko\core\Handler
{
	// @todo add to shared controller class (app namespace)
	public function __construct()
	{
		$identity = User::getIdentity();
        $this->addContentData("identity", $identity);
        $this->addPhpToJs("identity", $identity);
        
        parent::__construct();
    }

	/**
	 * Homepage Action (index)
	 * @params array $arguments
	 */
	public function indexAction($arguments = null)
	{
		$this->setPageTitle("Home");
		$this->setBodyTitle("Home");
		$this->setBodyContent("This is the home page.");

		// Add meta tags
		// $this->addMeta('This is Erdiko\'s hello world.', 'description');

		$this->setLayoutColumns(1);
	}

	/**
	 *
	 */
	public function contactAction($arguments = null)
	{	
		$cms = new Cms;
		$form = $cms->getContactForm();
		// $form = '<pre>'.print_r($form, true).'</pre>';

		$this->setBodyContent( $form );
		$this->setTitle('Contact Us');
		$this->setLayoutColumns(1);
	}

	/**
	 *
	 */
	public function contactUsAction($arguments = null)
	{
		$this->_getCmsPage('contact-page');
		/*$cms=new Cms();
		$this->setBodyContent($cms->getContactForm());*/
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
	protected function _getCmsPage($urlKey)
	{
		$cms = new Cms;
		$page = $cms->getNode($urlKey);

		// Add view data
		$this->setBodyTitle($this->_getTitle($page));
		$this->setBodyContent($this->_getBody($page));

		// Add page title
		$this->setPageTitle($this->_getPageTitle($page));

		// Add meta tags
		// $this->addMeta('This is Erdiko\'s hello world.', 'description');

		$this->setLayoutColumns(1);
	}

	/* -- Node Functions -- */
	
	/**
	 *
	 */
	protected function _getTitle($node)
	{
		return $node->title;
	}

	/**
	 *
	 */
	protected function _getPageTitle($node)
	{
		return $node->title;
	}

	/**
	 *
	 */
	protected function _getBody($node, $type='safe_value')
	{
		return $node->body['und'][0][$type];
	}



}