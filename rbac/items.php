<?php
return [
    'GUEST' => [
        'type' => 1,
        'children' => [
            'account.auth.login',
            'account.auth.register',
            'landing.index.index',
            'landing.error.index',
        ],
    ],
    'USER' => [
        'type' => 1,
        'children' => [
            'GUEST',
            'account.index.index',
            'account.auth.logout',
        ],
    ],
    'MANAGER' => [
        'type' => 1,
        'children' => [
            'USER',
        ],
    ],
    'ADMIN' => [
        'type' => 1,
        'children' => [
            'MANAGER',
        ],
    ],
    'account.index.index' => [
        'type' => 2,
        'ruleName' => 'account_rule',
    ],
    'account.auth.register' => [
        'type' => 2,
        'ruleName' => 'account_rule',
    ],
    'account.auth.login' => [
        'type' => 2,
        'ruleName' => 'account_rule',
    ],
    'account.auth.logout' => [
        'type' => 2,
        'ruleName' => 'account_rule',
    ],
    'landing.index.index' => [
        'type' => 2,
        'ruleName' => 'landing_rule',
    ],
    'landing.error.index' => [
        'type' => 2,
        'ruleName' => 'landing_rule',
    ],
];
