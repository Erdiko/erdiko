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
        'logger' => require getenv("ERDIKO_ROOT").'/config/logger.php',

        // Theme settings
        'theme' => require getenv("ERDIKO_ROOT").'/config/theme.php',

        // Database settings
        'database' => require getenv("ERDIKO_ROOT").'/config/database.php',
    ],
];
