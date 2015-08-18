<?php
/**
 * Created by Rem.
 * Author: Dmitry Kushneriv
 * Email: remkwadriga@yandex.ua
 * Date: 10-08-2015
 * Time: 12:27 PM
 */

use components\UserService;

$db = require(__DIR__ . '/db.php');
$routes = require(__DIR__ . '/routes.php');

return [
    'request' => [
        // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
        'cookieValidationKey' => 'hvb6xPBhQBgSjo2TsfOSOoAsKfSguOri',
    ],
    'cache' => [
        'class' => 'yii\caching\FileCache',
    ],
    'errorHandler' => [
        'errorAction' => 'site/error',
    ],
    'mailer' => [
        'class' => 'yii\swiftmailer\Mailer',
        // send all mails to a file by default. You have to set
        // 'useFileTransport' to false and configure a transport
        // for the mailer to send real emails.
        'useFileTransport' => true,
    ],
    'urlManager' => [
        'class' => 'yii\web\UrlManager',
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        'rules' => $routes,
        'enableStrictParsing' => true,
    ],
    'log' => [
        'traceLevel' => YII_DEBUG ? 3 : 0,
        'targets' => [
            [
                'class' => 'yii\log\FileTarget',
                'levels' => ['error', 'warning'],
            ],
        ],
    ],
    'db' => $db,

    'timeService' => [
        'class' => 'components\TimeService',
    ],
    'user' => [
        'class' => UserService::className(),
        'identityClass' => 'models\User',
        'enableAutoLogin' => true,
        'on ' . UserService::EVENT_AFTER_LOGIN => ['models\User', 'afterSuccessLogin'],
    ],
    'view' => [
        'class' => 'components\View',
    ],
    'authManager' => [
        'class' => 'components\AuthManager',
    ],
];