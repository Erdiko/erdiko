<?php
$base = dirname(dirname(__DIR__));
$webroot = dirname(__DIR__);
$core = $webroot.'/erdiko';
$app = $webroot.'/app';

// Static functions / Factories
require_once $webroot.'/Erdiko.php';

// Libraries
require_once $core.'/libraries/ToroPHP/toro.php';

// Interfaces
require_once $core.'/core/interfaces/Theme.php';
require_once $core.'/core/interfaces/Session.php';

// Core 
require_once $core.'/core/Handler.php';
require_once $core.'/core/Module.php';
require_once $core.'/core/datasource/MySql.php';

// Modules
require_once $core.'/modules/theme/ThemeEngine.php';
require_once $core.'/modules/theme/Handler.php';

// @todo get the autoloader working!

// RSVP
require_once $app.'/modules/contrib/rsvp/Handler.php';
require_once $app.'/modules/contrib/rsvp/models/Rsvp.php';

// Drupal
require_once $app.'/modules/contrib/drupal/Model.php';

// Decibel
require_once $app.'/modules/custom/decibel/Handler.php';
require_once $app.'/modules/custom/decibel/models/Cms.php';
