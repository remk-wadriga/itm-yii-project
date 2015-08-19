<?php
return [
    'landing.index.index' => [
        'type' => 2,
        'ruleName' => 'landing_rule',
    ],
    'landing.error.index' => [
        'type' => 2,
        'ruleName' => 'landing_rule',
    ],
    'account.auth.login' => [
        'type' => 2,
        'ruleName' => 'account_rule',
    ],
    'account.auth.register' => [
        'type' => 2,
        'ruleName' => 'account_rule',
    ],
    'GUEST' => [
        'type' => 1,
        'ruleName' => 'user_group_rule',
        'children' => [
            'landing.index.index',
            'landing.error.index',
            'account.auth.login',
            'account.auth.register',
        ],
    ],
    'account.index.index' => [
        'type' => 2,
        'ruleName' => 'account_rule',
    ],
    'account.auth.logout' => [
        'type' => 2,
        'ruleName' => 'account_rule',
    ],
    'USER' => [
        'type' => 1,
        'ruleName' => 'user_group_rule',
        'children' => [
            'GUEST',
            'account.index.index',
            'account.auth.logout',
        ],
    ],
    'MANAGER' => [
        'type' => 1,
        'ruleName' => 'user_group_rule',
        'children' => [
            'USER',
        ],
    ],
    'ADMIN' => [
        'type' => 1,
        'ruleName' => 'user_group_rule',
        'children' => [
            'MANAGER',
        ],
    ],
];
