<?php
return [
    'default' => [
        'host'     => '127.0.0.1',
        'username' => null,
        'password' => null,
        'port'     => 6379,
        'database' => 0,
        'pool' => [ // Connection pool settings
            'max_connections' => 10,     // Maximum connections in the pool
            'min_connections' => 1,      // Minimum connections in the pool
            'wait_timeout' => 3,         // Max wait time when acquiring a connection (seconds)
            'idle_timeout' => 50,        // Idle timeout; connections are closed after this until count reaches min_connections
            'heartbeat_interval' => 50,  // Heartbeat interval (do not exceed 60 seconds)
        ],
    ]
];