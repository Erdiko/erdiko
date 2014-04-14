<?php
/**
 * Index file
 * Intercepts all requests and dispatches to routing
 * 
 * @category  	Erdiko
 * @package   	Core
 * @copyright 	Copyright (c) 2013, Arroyo Labs, www.arroyolabs.com
 * @author		John Arroyo
 */

include_once dirname(__DIR__)."/erdiko/bootstrap.php";

$routes = Erdiko::getRoutes();

try {
	$site = new \ToroApplication( $routes );
	$site->serve();
} catch(\Exception $e) {
	echo $e->getMessage();
}