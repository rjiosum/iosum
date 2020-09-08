<?php

return [

    'guards' => [
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],

        'api:admin' => [
            'driver' => 'passport',
            'provider' => 'admins',
            'hash' => false,
        ],
    ],

    'providers' => [
        'admins' => [
            'driver' => 'eloquent',
            'model' => Iosum\AdminAuth\Models\Admin::class,
        ],
    ],
];
