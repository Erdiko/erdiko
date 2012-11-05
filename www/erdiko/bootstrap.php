<?php
$base = dirname(dirname(__DIR__));
$webroot = dirname(__DIR__);
$core = $webroot.'/erdiko';
$app = $webroot.'/app';

// Static functions / Factories
require_once $webroot.'/Erdiko.php';

// Libraries
require_once $core.'/libraries/ToroPHP/toro.php';

// Autoloader
require_once $core.'/core/autoload.php';

// Interfaces
require_once $core.'/core/interfaces/Theme.php';
require_once $core.'/core/interfaces/Session.php';

// Core 
require_once $core.'/core/Handler.php';
require_once $core.'/core/Module.php';
require_once $core.'/core/ModelAbstract.php';
require_once $core.'/core/datasource/MySql.php';

// Modules
require_once $core.'/modules/theme/ThemeEngine.php';
require_once $core.'/modules/theme/Handler.php';
// require_once $core.'/modules/drupal/Model.php';

// @todo get the autoloader working!

// App Handlers
// require_once $app.'/modules/custom/cms/Handler.php';
// require_once $app.'/modules/custom/cms/models/Cms.php';
require_once $app.'/modules/custom/hello/Handler.php';