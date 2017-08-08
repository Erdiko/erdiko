<?php
/* Database config */
return [
    'default' => 'master',
    'entities' => '/entities',
    'is_dev_mode' => getenv("ERDIKO_IS_DEV_MODE"),

    'connections' => [
        'master' => [
            'driver' => 'pdo_mysql',
            'host' => getenv("DB_HOST").":".getenv("DB_PORT"),
            'database' => getenv("DB_HOST"),
            'username' => getenv("DB_USERNAME"),
            'password' => getenv("DB_PASSWORD"),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => ''
        ]
    ]
];
