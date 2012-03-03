<?php
/**
 * 
 */

class Erdiko
{
	/**
	 * Factory Classes
	 */
	public static getModule()
	{
		
	}
	
	/**
	 * Get the compiled application routes from the config files
	 */
	public static function getRoutes()
	{
		// some dummy initial routes
		$routes = array(
				array('/', 'MainHandler'),
				array('test', 'TestHandler'),
				array("article/([a-zA-Z0-9_]+)", 'ArticleHandler')
			);
			
		return $routes;
	}
}