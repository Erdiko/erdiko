 <?php
$base = dirname(dirname(__DIR__));
$webroot = $base.'/www';

// Static functions / Factories
require_once $webroot.'/Erdiko.php';

// Libraries
require_once $webroot.'/libraries/ToroPHP/toro.php';

// Core 
require_once $webroot.'/erdiko/core/Handler.php';

// Modules
