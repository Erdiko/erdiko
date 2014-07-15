<?php
/**
 * Register framework autoload function
 * @category 	Erdiko
 * @package 	Core
 * @copyright 	Copyright (c) 2012, Arroyo Labs, http://www.arroyolabs.com
 * @author		John Arroyo, john@arroyolabs.com
 */

ini_set('include_path', ini_get('include_path') . PATH_SEPARATOR . "{$vendor}" . PATH_SEPARATOR . "{$app}/common/models" . PATH_SEPARATOR . "{$core}/core");


spl_autoload_register(function($name) 
{
	if(strpos($name, '\\') !== false)
	{
		$path = str_replace('\\','/',$name);
		$class = basename($path);
		$dir = '/'.dirname($path);
		$filename = APPROOT.$dir.'/'.$class.'.php';
		// error_log("file: $filename");

		if(is_file($filename))
		{
			require_once $filename;
			return;
		}
	}
});