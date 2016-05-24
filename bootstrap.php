<?php
define('ROOT', __DIR__);
define('WEBROOT', ROOT.'/public');
define('APPROOT', ROOT.'/app');
define('VARROOT', ROOT.'/var');

define('VENDOR', ROOT.'/vendor');
define('ERDIKO', VENDOR.'/erdiko/core/src');
define('VIEWS', APPROOT.'/views/');

// Memcache @todo move to config file
define('MEMCACHED_HOST', '127.0.0.1');
define('MEMCACHED_PORT', '11211');

// Core framework functions (static functions)
require_once ROOT.'/Erdiko.php';

// Core
require_once ERDIKO.'/Toro.php';
require_once ERDIKO.'/autoload.php';

// Composer
require_once VENDOR.'/autoload.php';

// load the application bootstrapper (user defined)
require_once APPROOT.'/appstrap.php';