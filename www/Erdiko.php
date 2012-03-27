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
	 * @todo get theme from config
	 * @return object $theme
	 */
	public static function getTheme()
	{
		// get Theme
		$themeEngine = new \erdiko\modules\theme\ThemeEngine();
		$themeEngine->loadTheme( 'core', 'default' );
		
		return $themeEngine;
	}
	
	/**
	 * Get the compiled application routes from the config files
	 */
	public static function getRoutes()
	{
		// some dummy initial routes
		// This needs to be moved to the app config
		$routes = array(
				array('/', '\erdiko\core\Handler'),
				array('test/([a-zA-Z0-9_/]+)', '\erdiko\core\Handler'),
				array("theme/([a-zA-Z0-9_/]+)/([a-zA-Z0-9_/]+)", '\erdiko\modules\theme\Handler'),
				array("([0-9][0-9][0-9][0-9])/([a-zA-Z0-9_/]+)", '\erdiko\core\Handler'),
				array("([a-zA-Z0-9_]+)", '\erdiko\core\Handler'),
				// array("([0-9]{4})", '\erdiko\core\Handler'),
				array("([0-9][0-9][0-9][0-9])/([a-zA-Z0-9_/]+)", '\erdiko\core\Handler'),
			);
		
		return $routes;
	}
}