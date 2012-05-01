 <?php
$base = dirname(dirname(__DIR__));
$webroot = $base.'/www';

// Static functions / Factories
require_once $webroot.'/Erdiko.php';

// Libraries
require_once $webroot.'/libraries/ToroPHP/toro.php';

// Interfaces
require_once $webroot.'/erdiko/core/interfaces/Theme.php';
require_once $webroot.'/erdiko/core/interfaces/Session.php';

// Core 
require_once $webroot.'/erdiko/core/Handler.php';
require_once $webroot.'/erdiko/core/Module.php';

// Modules
require_once $webroot.'/erdiko/modules/theme/ThemeEngine.php';
require_once $webroot.'/erdiko/modules/theme/Handler.php';

// RSVP - @todo get the autoloader working!
require_once $webroot.'/app/modules/rsvp/Handler.php';
