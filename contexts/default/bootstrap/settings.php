<?php
// All the settings needed to bootstrap your app and configure dependencies
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => '../app/templates',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'erdiko-default',
            'path' => ERDIKO_ROOT . '/var/logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        // Email settings
        'email' => require getenv("ERDIKO_ROOT").'/config/email.php',

        // Theme settings
        'theme' => require getenv("ERDIKO_ROOT").'/contexts/'.getenv("ERDIKO_CONTEXT").'/config/theme.php',
    ],
];
