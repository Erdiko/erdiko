<?php
/**
 * Default theme handler, 
 * Primarily for debugging and testing the theme
 * 
 * @category   Erdiko
 * @package    theme
 * @module	   Theme
 * @copyright Copyright (c) 2012, Arroyo Labs, www.arroyolabs.com
 * @author	John Arroyo
 */
namespace erdiko\modules\theme;


class Handler extends \erdiko\core\Handler
{
	public function get($name = null, $arguments = null)
	{
		$numColumns = 1;
		
		error_log("name: ".$name);
		error_log("arguments: ".$arguments);
		
		if( is_numeric($arguments) )
			$numColumns = $arguments;
		
		$data = array(
			'header' => array(
				'content' => "Header",
				'tagline' => "Theme Tester",
				'site_name' => "My Hello World Site",
			),
			'footer' => array(
				'content' => "Footer",
				'links' => array('link 1', 'link 2', 'link 3'),
			),
			'layout' => array(
				'columns' => $numColumns,
			),
			'main_content' => "Hello World...",
			'title' => "Home Page Title",
			'sidebar' => array(
				array(
					'block_title' => 'block 1',
					'block_content' => 'blah blah blah...',
				),
			),
		);
		
		$this->theme($data);
	}
}