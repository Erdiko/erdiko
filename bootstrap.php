<?php
// Start session
require getenv("ERDIKO_ROOT") . '/vendor/erdiko/core/session.php';

// Set up dependencies
require_once __DIR__ . '/bootstrap/dependencies.php';

// Register middleware
require_once __DIR__ . '/bootstrap/middleware.php';

// Register routes
require_once __DIR__ . '/bootstrap/routes.php';
