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
define('ERDIKO_ROOT', dirname(__DIR__)); // @todo move, perhaps use a setenv?
require ERDIKO_ROOT . '/vendor/erdiko/core/bootstrap.php';
require ERDIKO_ROOT . '/vendor/erdiko/core/session.php'; // @todo put somewhere else?

// Instantiate the app (autoloads the context settings)
$app = new \erdiko\App();

// Bootstrap your app (context)
require ERDIKO_ROOT."/contexts/".getenv('ERDIKO_CONTEXT')."/bootstrap.php";

// Run the app (autoloads the context bootstrap)
$app->run();
