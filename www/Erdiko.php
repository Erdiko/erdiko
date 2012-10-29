<?php
/**
 * Erdiko
 * All factory classes and global helper
 * 
 * @category	Erdiko
 * @package		Erdiko
 * @copyright 	Copyright (c) 2012, Arroyo Labs, www.arroyolabs.com
 * @author		John Arroyo, john@arroyolabs.com
 */

class Erdiko
{
	/**
	 * Factory Module Classes
	 */
	public static function getModule($moduleName)
	{
		
	}
	
	/**
	 * get the registered theme
	 * @param string $name
	 * @param string $namespace
	 * @param string $path
	 * @return object $theme
	 */
	public static function getTheme($name = 'default', $namespace = '\erdiko\theme\default', $path = '/erdiko/theme/default', $extras = null)
	{
		// get Theme
		$themeEngine = new \erdiko\modules\theme\ThemeEngine();
		$themeEngine->loadTheme($name, $namespace, $path, $extras);
		
		return $themeEngine;
	}
	
	/**
	 * Load a template file from a module
	 * @param string $filename
	 * @param mixed $data, data to expose to template
	 * 
	 * @todo can we deprecate this function and only use the one in the theme engine? -John
	 */
	public static function getTemplate($filename, $data)
	{
		if (is_file($filename))
		{
			ob_start();
			include $filename;
			return ob_get_clean();
		}
		return false;
	}
	
	/**
	 * Read JSON config file and return array
	 * @param filename $filename
	 * @return array $config
	 */
	public static function getConfigFile($file)
	{
		$data = str_replace("\\", "\\\\", file_get_contents($file));
		$json = json_decode($data, TRUE);
		
		// error_log("$file raw: ".print_r($data, TRUE));
		// error_log("$file array: ".print_r($json, TRUE));
		
		return $json;
	}
	
	public static function getConfig($name)
	{
		// @todo check cache first
		$webroot = __DIR__;
		$file = $webroot."/app/config/$name.json";
		
		return self::getConfigFile($file);
	}
	
	/**
	 * Get the compiled application routes from the config files
	 * 
	 * @todo cache the loaded/compiled routes
	 */
	public static function getRoutes()
	{
		$file = __DIR__.'/app/config/contexts/application.json';
		$applicationConfig = Erdiko::getConfigFile($file);
		
		return $applicationConfig['routes'];
	}
	
	/**
	 * send email
	 */
	public static function sendEmail($toEmail, $subject, $body, $fromEmail)
	{	
		$headers = "From: $fromEmail\r\n" .
			"Reply-To: $fromEmail\r\n" .
			"X-Mailer: PHP/" . phpversion();
		
		return mail($toEmail, $subject, $body, $headers);
	}
	
}