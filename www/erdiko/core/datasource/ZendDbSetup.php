<?php

/**  GET CONFIGS FROM json FILE ***/
$config = Erdiko::getConfig('database');
// Use the master settings for now
$config = $config['master'];

//var_dump($config);exit;

/* CREATE THE DB ADABPTER OUT OF CONFIGURATIONS */
$db = Zend_Db::factory($config['adapter'], $config['params']);

/* @TODO: ATTACH THE PROFILER TO THE DB ADAPTER */

/* RUN BASIC QUERIES TO HAVE THE DATA ENTIRELY IN UNICODE */
//$db->query('SET NAMES utf8');
//$db->query('SET CHARACTER SET utf8');

/* SETUP A FIXED DATABASE ADAPTER FOR ALL MODELS THROUGHOUT THE ENTIRE APPLICATION */
Abstract_Table::setDefaultAdapter($db);