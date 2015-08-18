<?php
return [
    'login' => [
        'type' => 2,
    ],
    'logout' => [
        'type' => 2,
    ],
    'error' => [
        'type' => 2,
    ],
    'register' => [
        'type' => 2,
    ],
    'index' => [
        'type' => 2,
    ],
    'list' => [
        'type' => 2,
    ],
    'view' => [
        'type' => 2,
    ],
    'update' => [
        'type' => 2,
    ],
    'delete' => [
        'type' => 2,
    ],
    'GUEST' => [
        'type' => 1,
        'ruleName' => 'userGroup',
        'children' => [
            'login',
            'logout',
            'error',
            'register',
            'index',
            'list',
            'view',
        ],
    ],
    'USER' => [
        'type' => 1,
        'ruleName' => 'userGroup',
        'children' => [
            'update',
            'GUEST',
        ],
    ],
    'MANAGER' => [
        'type' => 1,
        'ruleName' => 'userGroup',
        'children' => [
            'update',
            'USER',
        ],
    ],
    'ADMIN' => [
        'type' => 1,
        'ruleName' => 'userGroup',
        'children' => [
            'delete',
            'MANAGER',
        ],
    ],
];
