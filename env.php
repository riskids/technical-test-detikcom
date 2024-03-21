<?php
$variables = [
    'DB_HOST' => '127.0.0.1',
    'DB_USERNAME' => 'root',
    'DB_PASSWORD' => '',
    'DB_NAME' => 'test_detikcom',
    'DB_PORT' => 3306,
];

foreach ($variables as $key => $value) {
    putenv("$key=$value");
}
