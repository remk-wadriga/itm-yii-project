<?php

$namespaces = require(__DIR__ . '/namespaces.php');
foreach($namespaces as $alias => $path){
    Yii::setAlias('@' . $alias, __DIR__ . '/../' . $path);
}


$params = require(__DIR__ . '/params.php');
$components = require(__DIR__ . '/components.php');
$modules = require(__DIR__ . '/modules.php');

$config = [
    'id' => 'Itm',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => $components,
    'params' => $params,
    'modules' => $modules,
    'language' => 'ru',
    'sourceLanguage' => 'en',
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
