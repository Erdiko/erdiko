<?php
/**
 * Index file
 * Intercepts request and sends a response
 *
 * @package	 	public
 * @copyright   2012-2017 Arroyo Labs, Inc. http://www.arroyolabs.com
 * @author      John Arroyo <john@arroyolabs.com>
 */

// Bootstrap erdiko & composer autoload
define('ERDIKO_ROOT', dirname(__DIR__));
require dirname(__DIR__) . '/vendor/erdiko/core/bootstrap.php';
session_start(); // @todo put somewhere else, startSession()

// Instantiate the app
$app = new \erdiko\App();

require ERDIKO_ROOT."/contexts/".getenv('ERDIKO_CONTEXT')."/bootstrap.php";

// Run the app
$app->run();
