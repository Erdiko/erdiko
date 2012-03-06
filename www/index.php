<?php

include_once __DIR__."/erdiko/bootstrap.php";

$routes = Erdiko::getRoutes();

$site = new \ToroApplication( $routes );

$site->serve();