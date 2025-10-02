<?php
/**
 * Database Configuration File
 * Modify these settings according to your database setup
 */

// Database connection settings
define('DB_HOST', 'localhost');
define('DB_USER', 'fpjjkpte_quatre');
define('DB_PASS', 'quatre@2024');
define('DB_CHARSET', 'utf8mb4');

// Application settings
define('ROWS_PER_PAGE', 50);
define('MAX_QUERY_LENGTH', 10000);

// Security settings
define('SESSION_TIMEOUT', 3600); // 1 hour

// Feature flags
define('ALLOW_DELETE', true);
define('ALLOW_INLINE_EDIT', true);
define('ALLOW_SQL_QUERIES', true);



// Return configuration as an array
return [
    'database' => [
        'host' => DB_HOST,
        'username' => DB_USER,
        'password' => DB_PASS,
        'charset' => DB_CHARSET,
    ],
    'pagination' => [
        'per_page' => ROWS_PER_PAGE,
    ],
    'features' => [
        'delete' => ALLOW_DELETE,
        'inline_edit' => ALLOW_INLINE_EDIT,
        'sql_queries' => ALLOW_SQL_QUERIES,
    ]
];
