<?php

include_once __DIR__."/erdiko/bootrap.php";

$routes = Erdiko::getRoutes();

$site = new ToroApplication( $routes );

$site->serve();