<?php
return [
    'type' => 'queue',
    'config' => [
        [
            'name' => 'redislog',
            'driver' => 'redis',
            'host' => 'localhost',
            'persisted' => true,
            'port' => 6379,
            'pass' => '',
            'database' => 5,
            'consumer' => [
                'Test',
                'fn'
            ]
        ],
        [
            'name' => 'redisall',
            'driver' => 'redis',
            'host' => 'localhost',
            'persisted' => true,
            'port' => 6379,
            'pass' => '',
            'database' => 3,
            'consumer' => [
                'Test',
                'fn'
            ]
        ],
        [
            'name' => 'rabbit',
            'driver' => 'rabbit',
            'host' => 'localhost',
            'vhost' => 'services',
            'port' => 5672,
            'user' => 'admin',
            'pass' => 's0m3p4ssw0rd',
            'exchange' => 'logger',
            'queue_type' => 'direct',
            'persisted' => true,
            'consumer' => 'Test'
        ]
    ]
];