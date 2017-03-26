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
require dirname(__DIR__) . '/vendor/autoload.php';
session_start(); // @todo put somewhere else, startSession()

// Load app settings
$settings =  require dirname(__DIR__) . '/src/settings.php'; // getSettings()
// $settings =  \erdiko\App::getSettings(); // getSettings()

// Instantiate the app
$app = new \Slim\App($settings);
require dirname(__DIR__) . '/src/bootstrap.php';

// Run the app
$app->run();
