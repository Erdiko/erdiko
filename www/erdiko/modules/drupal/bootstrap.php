<?php
/**
 * Assumes Drupal is installed at the same level as erdiko.
 * /drupal (Drupal root)
 * /www (Erdiko root)
 */

/*
// Prevent this from running under a webserver (for unit testing only)
if (array_key_exists('REQUEST_METHOD', $_SERVER)) 
{
	echo 'This page is not accessible from a browser.';
	exit(1);
}
*/

//set the working directory and required Drupal 7 variables
define('DRUPAL_ROOT', dirname(dirname(dirname(dirname(__DIR__)))).'/drupal');

chdir(DRUPAL_ROOT);

$_SERVER['REQUEST_METHOD'] = 'get';
$_SERVER['REMOTE_ADDR'] = '127.0.0.1';

require_once DRUPAL_ROOT.'/includes/bootstrap.inc';

drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
