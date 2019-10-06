<?php
/**
 * Created by PhpStorm.
 * User: merdan
 * Date: 10/6/2019
 * Time: 20:08
 */
return [
    'defaults' => [
        'guard' => 'api',
        'passwords' => 'users',
    ],

    'guards' => [
        'api' => [
            'driver' => 'jwt',
            'provider' => 'users',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => \App\User::class
        ]
    ]
];