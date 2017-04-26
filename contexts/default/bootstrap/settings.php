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

        // Theme settings
        'theme' => [
            'templates' => ['../app/templates', '../vendor/erdiko/theme/templates'],
            'debug' => true,
            'cache' => false
            // 'cache' => '/tmp/erdiko/theme'
        ],
    ],
];
