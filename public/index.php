<?php
/**
 * Index file
 * Intercepts all requests and dispatches routing
 *
 * @category    Erdiko
 * @package     Public
 * @copyright   Copyright (c) 2014, Arroyo Labs, www.arroyolabs.com
 * @author      John Arroyo
 */

include_once dirname(__DIR__)."/bootstrap.php";

try {
    $routes = Erdiko::getRoutes();
    Toro::serve($routes);

} catch (\Exception $e) {
    echo $e->getMessage();
    // @todo return a 500 error & log error
}
