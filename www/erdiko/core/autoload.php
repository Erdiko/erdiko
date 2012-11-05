<?php
/**
 * Register framework autoload function
 * @category   Erdiko
 * @package    Core
 * @copyright  Copyright (c) 2012, Arroyo Labs, http://www.arroyolabs.com
 * @author	John Arroyo, john@arroyolabs.com
 */

spl_autoload_register(function($name) {
	static $dirCache = array();

	// error_log("autoload this.");
	// error_log("name: ".$name);

	if(strpos($name,'\\') !== false)
	{
		$path = str_replace('\\','/',$name);
		$class = basename($path);
		$dir = $webroot.'/'.dirname($path);

		if(is_file($dir.'/'.$class.'.php'))
		{
			require_once $dir.'/'.$class.'.php';
			return;
		}
	}
});