<?php
// This is global bootstrap for autoloading
\Codeception\Configuration::$defaultSuiteSettings['modules']['config'] = [
    'Db' => [
        'dsn' => 'pgsql:host=' . getenv('TEST_DB_HOST') . ';dbname=' . getenv('TEST_DB_NAME'),
        'user' => getenv('TEST_DB_USER'),
        'password' => getenv('TEST_DB_PASS'),
        'dump' => 'tests/_data/dump.sql',
        'populate' => true,
        'cleanup' => true
    ]
];
