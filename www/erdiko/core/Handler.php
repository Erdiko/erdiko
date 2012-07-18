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
    protected $_localConfig;
	protected $_webroot;
	
	public function __construct()
	{
		$this->_webroot = dirname(dirname(__DIR__));
		$file = $this->_webroot.'/app/config/contexts/application.inc';
		$this->_localConfig = Erdiko::getConfigFile($file);
	}
	
	public function theme($data)
	{
		$theme = Erdiko::getTheme($this->_localConfig['theme']['name'], $this->_localConfig['theme']['namespace'], $this->_localConfig['theme']['path']);
		$theme->theme($data);
	}
	
	/**
	 * @param string $arguments
	 * @return array $arguments
	 */
	public function parseArguments($arguments)
	{
		$arguments = explode("/", $arguments); 
		return $arguments;
	}
	
    public function get($name = null, $arguments = null)
	{
		//error_log("name: ".$name);
		//error_log("arguments: ".$arguments);
		
		$data = array(
			'header' => array(
				'content' => "Header",
				'tagline' => "Booyah",
				'site_name' => "My Hello World Site",
			),
			'footer' => array(
				'content' => "Footer",
				'links' => array('link 1', 'link 2', 'link 3'),
			),
			'layout' => array(
				'columns' => 1,
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
