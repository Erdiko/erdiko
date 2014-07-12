<?php
/**
 * Assumes Magento is installed at the same level as erdiko.
 * /magento (Magento root)
 * /www (Erdiko root)
 */

//set the working directory and required Drupal 7 variables
define('MAGENTO_ROOT', dirname(dirname(dirname(dirname(__DIR__)))).'/magento');

// request uri is not set on the command line
if(!isset($_SERVER['REQUEST_URI'])){
	$_SERVER['REQUEST_URI'] = '/';
}
// Set PATH_INFO variable if it is not set
if (!isset($_SERVER['PATH_INFO'])) {
        $_SERVER['PATH_INFO'] = preg_replace('/\/index.php/','',$_SERVER['REQUEST_URI'],1);
		$_SERVER['PATH_INFO'] = preg_replace('/\?(.)*$/','',$_SERVER['PATH_INFO'],1);
}
