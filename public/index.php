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
require ERDIKO_ROOT . '/vendor/erdiko/core/bootstrap.php';
session_start(); // @todo put somewhere else, startSession()

// Load app settings
$settings = require ERDIKO_ROOT."/contexts/".getenv('ERDIKO_CONTEXT')."/bootstrap/settings.php";
// $settings =  \erdiko\App::getSettings(); // getSettings()

// Instantiate the app
$app = new \Slim\App($settings);

require ERDIKO_ROOT."/contexts/".getenv('ERDIKO_CONTEXT')."/bootstrap.php";

// Run the app
$app->run();
