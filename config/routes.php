<?php
/**
 * Created by Rem.
 * Author: Dmitry Kushneriv
 * Email: remkwadriga@yandex.ua
 * Date: 10-08-2015
 * Time: 12:31 PM
 */

$baseRouting = [
    // Landing page
    '/'                                                                             => 'site/index',

    // Modules base routing
    '<module>'                                                                      => '<module>/index/index',
    '<module>/<controller><id:\d+>/<action>'                                        => '<module>/<controller>/<action>',
    '<module>/<controller>/<id:\d+>'                                                => '<module>/<controller>/view',
    '<module>/<controller>/<action>'                                                => '<module>/<controller>/<action>',
    '<module>/<controller>s'                                                        => '<module>/<controller>/list',


    // Base Routing
    '<controller>/<id:\d+>/<action>'                                                => '<controller>/<action>',
    '<controller>/<id:\d+>'                                                         => '<controller>/view',
    '<controller>/<action>'                                                         => '<controller>/<action>',
    '<controller>s'                                                                 => '<controller>/list',
];

// Including the custom modules routing
$accountRouting = require(__DIR__ . '/../modules/account/config/routing.php');
$accountRouting = require(__DIR__ . '/../modules/landing/config/routing.php');

return array_merge($accountRouting, $baseRouting);