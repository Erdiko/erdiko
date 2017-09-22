<?php

error_reporting('E_ALL');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
date_default_timezone_set('UTC');

require_once realpath(getenv('ERDIKO_ROOT').'/vendor/autoload.php');