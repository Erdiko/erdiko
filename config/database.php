<?php
/* Database config */
return [
    'default' => 'master',

    'meta' => [
        'entities' => [
            getenv("ERDIKO_ROOT").'/app/entities'
        ],
        'is_dev_mode' => getenv("ERDIKO_IS_DEV_MODE"),
        'cache' => null,
    ],

    'connections' => [
        'master' => [
            'driver' => 'pdo_mysql',
            'host' => getenv("DB_HOST"),
            'port' => getenv("DB_PORT"),
            'database' => getenv("DB_DATABASE"),
            //'username' => getenv("DB_USERNAME"),
            'username' => 'root',
            'password' => getenv("DB_PASSWORD"),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => ''
        ]
    ]
];
