<?php
/**
 * Examples Controller
 * Multiple examples of how you can use erdiko.  It includes some simple use cases.
 *
 * @category    app
 * @package     controllers
 * @copyright   Copyright (c) 2016, Arroyo Labs, www.arroyolabs.com
 * @author      John Arroyo, john@arroyolabs.com
 */
namespace app\controllers;


/**
 * AjaxExample Class
 */
class AjaxExample extends \erdiko\core\AjaxController
{
	
	/**
     * Get
     */
	public function get($var = null)
	{
		if($var != null)
		{
			// load action
			return $this->_autoaction($var);
		}

		$data = array("hello", "world");
		$view = new \erdiko\core\View('examples/helloworld', $data);
		
		$this->setContent($view);
	}

	/**
   	 * Get Example
   	 */
	public function getExample()
	{
		$content = array(
			'hello' => 'world',
			'ajax' => 'rocks'
			);

		$this->setContent($content);
	}

}
