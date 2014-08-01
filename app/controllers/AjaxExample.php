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
			return $this->autoaction($var);
		}

		$m = new \Mustache_Engine;
		$test = $m->render('Hello, {{ planet }}!', array('planet' => 'world')); // Hello, world!

		// error_log("mustache = {$test}");
		// error_log("var: ".print_r($var, true));

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