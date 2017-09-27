<?php
/* Theme config */
return [
    // Twig settings
    'namespace' => '/themes/bootstrap',
    'templates' => ['../app/templates', '../vendor/erdiko/theme/templates'],
    'debug' => getenv("ERDIKO_IS_DEV_MODE"),
    'cache' => false, // 'cache' => '/tmp/erdiko/theme',
    // Application settings
    'application' => require getenv("ERDIKO_ROOT").'/config/application.php',
    // Default settings
    'language' => 'en',
    'view' => 'layouts/1column.html',
    'pagesize' => 10,
    // Theme details
    'meta' => [
        'viewport' => 'width=device-width, initial-scale=1',
        'description' => 'A PHP framework for lean web development'
    ],
    'google' => [
        'analytics' => [
            'tracking_id' => getenv("GOOGLE_ANALYTICS_ID")
        ],
        'tag_manager' => []
    ],
    'menus' => [
        'main' => [
            ['title' => 'Log Menu', 'href' => '/log'],
            ['title' => 'Create', 'href' => '/create'],

        ],
        'footer' => [
            ['title' => 'Examples', 'href' => '/examples'],
            ['title' => 'Grid', 'href' => '/examples/grid/12'],
            ['title' => 'Markup', 'href' => '/examples/markup'],
            ['title' => 'Home', 'href' => '/'],
            ['title' => 'View Config', 'href' => '/examples/config'],
            ['title' => 'About', 'href' => '/examples/about'],
        ]
    ]
];
