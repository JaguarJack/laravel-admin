<?php

return [
    'auth' => [
        'guards' => [
            'admin' => [
                'driver' => 'session',
                'provider' => 'admin_users',
            ],
        ],
        
        'admin_users'  => [
            'driver' => 'eloquent',
            'model' => Lizyu\Admin\Model\User::class,
        ],
    ],
    
    'table' => 'admin_users',
    
];
