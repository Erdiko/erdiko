<?php
/**
 * Index file
 * Intercepts request and dispatch routes
 *
 * @package	 	erdiko/erdiko
 * @copyright   2012-2017 Arroyo Labs, Inc. http://www.arroyolabs.com
 * @author      John Arroyo <john@arroyolabs.com>
 */

// Bootstrap your app (and erdiko)
require_once dirname(dirname(__DIR__))."/app/bootstrap.php";

try {
	\erdiko\core\ErrorHandler::init(); // Front-end error management
	Erdiko::serve();

} catch (\Exception $e) {
    echo $e->getMessage();
    Erdiko::error("Failed to serve route. ".$e->getMessage());
}
