<?php
/** important: download zend and place in /www/libraries/Zend **/

// Register Zend autoloader
require_once("Zend/Loader.php");
spl_autoload_register(array("Zend_Loader", "loadClass"));

/**  GET CONFIGS FROM json FILE ***/
$config = Erdiko::getConfig('local/database');

// Use the master settings for now
$config = $config['master'];

/* CREATE THE DB ADABPTER OUT OF CONFIGURATIONS */
$db = Zend_Db::factory($config['adapter'], $config['params']);

/* @TODO: ATTACH THE PROFILER TO THE DB ADAPTER */

/* RUN BASIC QUERIES TO HAVE THE DATA ENTIRELY IN UNICODE */
//$db->query('SET NAMES utf8');
//$db->query('SET CHARACTER SET utf8');

/* SETUP A FIXED DATABASE ADAPTER FOR ALL MODELS THROUGHOUT THE ENTIRE APPLICATION */
Abstract_Table::setDefaultAdapter($db);