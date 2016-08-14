<?php
/**
 * Index file
 * Intercepts all requests and dispatch routes
 *
 * @category    Erdiko
 * @package     Public
 * @copyright   Copyright (c) 2016, Arroyo Labs, www.arroyolabs.com
 * @author      John Arroyo
 */

include_once dirname(__DIR__)."/bootstrap.php";

// @todo move to bootstrap or appstrap?
if(empty(getenv('ERDIKO_CONTEXT')))
	putenv("ERDIKO_CONTEXT=default");
// $_ENV['ERDIKO_CONTEXT'] = 'default';

try {
    $routes = Erdiko::getRoutes(getenv('ERDIKO_CONTEXT'));
    Toro::serve($routes);

} catch (\Exception $e) {
    echo $e->getMessage();
    // @todo return a 500 error & log error
}
