<?php
/**
 * Handler
 * Base request handler, All handlers should inherit this class.
 * 
 * @category   Erdiko
 * @package    Core
 * @copyright  Copyright (c) 2012, Arroyo Labs, http://www.arroyolabs.com
 * @author	   John Arroyo
 */
namespace erdiko\core;
use Erdiko;

class Handler extends \ToroHandler 
{
    // public function __construct() { }
	
	public function theme($data)
	{
		$theme = Erdiko::getTheme();
		$theme->theme($data);
	}
	
    public function get($param = null)
	{
		// error_log("Hello World!");
		
		$data = array(
			'main_content' => "Hello World",
			'title' => "Home Page",
			'sidebar' => array(
				array(
					'blah' => 'blah',
					'blah_blah' => 'blah blah',
				),
			),
		);
		
		$this->theme($data);
	}
}
