<?php
/**
 * 
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
	 * Get the compiled application routes from the config files
	 */
	public static function getRoutes()
	{
		// some dummy initial routes
		$routes = array(
				array('/', '\erdiko\core\Handler'),
				array('test', 'TestHandler'),
				array("article/([a-zA-Z0-9_]+)", 'ArticleHandler')
			);
			
		return $routes;
	}
}