<?php

return [
    'auth' => [
        'guards' => [
            'admin' => [
                'driver' => 'session',
                'provider' => 'admin_users',
            ],
        ],
        'providers' => [
                'admin_users'  => [
                    'driver' => 'eloquent',
                    'model' => Lizyu\Admin\Model\User::class,
                ],
            ],
    ],

    
    'table' => 'admin_users',
    
];
