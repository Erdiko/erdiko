<?php
define('ROOT', __DIR__);
define('WEBROOT', ROOT.'/public');
define('APPROOT', ROOT.'/app');
define('VARROOT', ROOT.'/var');

define('VENDOR', ROOT.'/vendor');
define('ERDIKO', VENDOR.'/erdiko/core/src/erdiko');
//define('ERDIKO', APPROOT.'core/src/erdiko');
//define('SHOPIFY', VENDOR.'/erdiko/shopify/');
define('VIEWS', APPROOT.'/views/');

// Memcache @todo move to config file
define('MEMCACHED_HOST', '127.0.0.1');
define('MEMCACHED_PORT', '11211');

// Core framework functions (static functions)
require_once ROOT.'/Erdiko.php';

// Core
require_once ERDIKO.'/Toro.php';
require_once ERDIKO.'/core/autoload.php';

// Temp hack loader @todo use composer's autoloader for core
require_once ERDIKO.'/core/Controller.php';
require_once ERDIKO.'/core/AjaxController.php';
require_once ERDIKO.'/core/ModelAbstract.php';
require_once ERDIKO.'/core/Response.php';
require_once ERDIKO.'/core/AjaxResponse.php';
require_once ERDIKO.'/core/Container.php';
require_once ERDIKO.'/core/Theme.php';
require_once ERDIKO.'/core/Layout.php';
require_once ERDIKO.'/core/View.php';
require_once ERDIKO.'/core/datasource/File.php';
require_once ERDIKO.'/core/cache/CacheInterface.php';
require_once ERDIKO.'/core/cache/File.php';
require_once ERDIKO.'/core/Cache.php';
require_once ERDIKO.'/core/Logger.php';
require_once ERDIKO.'/core/cache/Memcached.php';
//require_once VENDOR.'/erdiko/shopify/src/Shopify.php';

// Composer
require_once VENDOR.'/autoload.php';

// load the application bootstrapper (user defined)
require_once APPROOT.'/appstrap.php';