<?php
// Start session
// require_once __DIR__ . '/config/session.php';
//require getenv("ERDIKO_ROOT") . '/vendor/erdiko/core/session.php';
// \erdiko\session\Session::start();
// \erdiko\session\Session::set("start", true);

// Set up dependencies
require_once __DIR__ . '/bootstrap/dependencies.php';

// Register middleware
require_once __DIR__ . '/bootstrap/middleware.php';

// Register routes
require_once __DIR__ . '/bootstrap/routes.php';
