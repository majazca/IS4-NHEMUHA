<?php
 
return [
    'password' => [
        'super_admin' => env('SUPER_ADMIN_PASSWORD'),
        'admin' => env('ADMIN_PASSWORD'),
        'subscriber' => env('SUBSCRIBER_PASSWORD'),
        'client' => env('CLIENT_PASSWORD'),
    ],
    'roles' => [
        'super_admin' => 'Super Admin',
        'admin' => 'Vendedor',
        'id_vendedor' => '1',
        'subscriber' => 'Subscriber',
        'client' => 'Client',
    ]
];