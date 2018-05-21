<?php
/**
 * Store database credentials here in a single file
 * that can be required wherever necessary.
 */
return [
    'database' => [
        'name' => 'cosc3380',
        'username' => 'homestead',
        'password' => 'secret',
        'connection' => 'mysql:host=127.0.0.1',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    ]
];