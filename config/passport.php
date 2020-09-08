<?php

return [
    'admin' => [
        'url' => env('ADMIN_PASSPORT_OAUTH_TOKEN_URL', '/oauth/token'),

        'cookie' => [
            'name' => env('ADMIN_PASSPORT_COOKIE_NAME', '_admintoken'),
            'minutes' => env('ADMIN_PASSPORT_COOKIE_MINUTES', 0),
            'path' => env('ADMIN_PASSPORT_COOKIE_PATH', null),
            'domain' => env('ADMIN_PASSPORT_COOKIE_DOMAIN', null),
            'secure' => env('ADMIN_PASSPORT_COOKIE_SECURE', null), //null for localhost, true for production
            'httponly' => env('ADMIN_PASSPORT_COOKIE_HTTPONLY', true),
            'raw' => env('ADMIN_PASSPORT_COOKIE_RAW', false),
            'samesite' => env('ADMIN_PASSPORT_COOKIE_SAMESITE', 'strict') //strict or lxs
        ]
    ]
];
