<?php
/**
 * Index file
 * Intercepts request and sends a response
 *
 * @package	 	public
 * @copyright   2012-2017 Arroyo Labs, Inc. http://www.arroyolabs.com
 * @author      John Arroyo <john@arroyolabs.com>
 */

// Bootstrap erdiko (& composer)
require getenv("ERDIKO_ROOT").'/vendor/erdiko/core/bootstrap.php';

// Instantiate the app (autoloads the context settings)
$app = new \erdiko\App();

// Bootstrap your app
require getenv("ERDIKO_ROOT")."/bootstrap.php";

// Run the app (autoloads the context bootstrap)
$app->run();

/** For multi site pass settings file to the \erdiko\App() and call your site specific bootstrap **/
