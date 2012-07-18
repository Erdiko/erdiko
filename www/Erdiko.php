<?php
/**
 * Erdiko
 * All factory classes and global helper
 * 
 * @category   Erdiko
 * @package    Erdiko
 * @copyright Copyright (c) 2012, Arroyo Labs, www.arroyolabs.com
 * @author	John Arroyo
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
	 * @return object $theme
	 */
	public static function getTheme($name = 'default', $namespace = '\erdiko\theme\default', $path = '/erdiko/theme/default')
	{
		// get Theme
		$themeEngine = new \erdiko\modules\theme\ThemeEngine();
		$themeEngine->loadTheme($name, $namespace, $path);
		
		return $themeEngine;
	}
	
	/**
	 * Load a template file from a module
	 * @param string $filename
	 * @param mixed $data, data to expose to template
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
		$file = $webroot."/app/config/$name.inc";
		
		return self::getConfigFile($file);
	}
	
	/**
	 * Get the compiled application routes from the config files
	 */
	public static function getRoutes()
	{
		$primaryHandler = '\app\modules\rsvp\Handler'; // override for rsvp app
		
		// some dummy initial routes
		// This needs to be moved to the app config
		$routes = array(
				array('/', $primaryHandler),
				array('test/([a-zA-Z0-9_/]+)', $primaryHandler),
				array("theme/([a-zA-Z0-9_/]+)/([a-zA-Z0-9_/]+)", '\erdiko\modules\theme\Handler'),
				array("([0-9][0-9][0-9][0-9])/([a-zA-Z0-9_/]+)", $primaryHandler),
				array("([a-zA-Z0-9_]+)", $primaryHandler),
				array("([a-zA-Z0-9_]+)/([a-zA-Z0-9_/]+)", $primaryHandler),
				array("([0-9][0-9][0-9][0-9])/([a-zA-Z0-9_/]+)", $primaryHandler),
			);
		
		return $routes;
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