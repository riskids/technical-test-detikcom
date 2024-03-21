<?php
include "./src/utils/autoload.php";

return
    [
        'paths' => [
            'migrations' => '%%PHINX_CONFIG_DIR%%/src/db/migrations',
            'seeds' => '%%PHINX_CONFIG_DIR%%/src/db/seeds'
        ],
        'environments' => [
            'default_migration_table' => 'phinxlog',
            'default_environment' => 'development',
            'production' => [
                'adapter' => 'mysql',
                'host' => '127.0.0.1',
                'name' => 'production_db',
                'user' => 'root',
                'pass' => '',
                'port' => '3306',
                'charset' => 'utf8',
            ],
            'development' => [
                'adapter' => 'mysql',
                'host' => env('DB_HOST'),
                'name' => env('DB_NAME'),
                'user' => env('DB_USERNAME'),
                'pass' => env('DB_PASSWORD'),
                'port' => '3306',
                'charset' => 'utf8',
            ],
            'testing' => [
                'adapter' => 'mysql',
                'host' => '127.0.0.1',
                'name' => 'testing_db',
                'user' => 'root',
                'pass' => '',
                'port' => '3306',
                'charset' => 'utf8',
            ]
        ],
        'version_order' => 'creation'
    ];
