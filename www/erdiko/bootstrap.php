<?php
ini_set('display_errors', '1');
define('WEBROOT', dirname(__DIR__));
define('ZEND', false); // is zend included or not

$core = WEBROOT.'/erdiko';
$app = WEBROOT.'/app';
$vendor = dirname(dirname(__DIR__))."/vendor";

// Static functions / Factories
require_once WEBROOT.'/Erdiko.php';

// Libraries
require_once WEBROOT.'/libraries/ToroPHP/toro.php';

// Interfaces
require_once $core.'/core/interfaces/Theme.php';
require_once $core.'/core/interfaces/Session.php';

// Core 
require_once $core.'/core/Handler.php';
require_once $core.'/core/Module.php';
require_once $core.'/core/ModelAbstract.php';

// Core Modules
require_once $core.'/modules/theme/ThemeEngine.php';
require_once $core.'/modules/theme/Handler.php';
// require_once $core.'/modules/drupal/Model.php';

// Helpers
require_once $core.'/core/Helper.php';

// Autoloader(s)
require_once $core.'/core/autoload.php';
if(ZEND)
	require_once $core.'/core/datasource/ZendDbSetup.php';
require_once $core.'/core/session.php';

// load the user defined bootstrapper
require_once $app.'/appstrap.php';
