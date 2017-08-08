<?php
/* Logger config */
return [
    'name' => 'erdiko',
    'path' => getenv("ERDIKO_ROOT").'/var/logs/app.log',
    'level' => \Monolog\Logger::DEBUG,
];
