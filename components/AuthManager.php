<?php
/**
 * Created by Rem.
 * Author: Dmitry Kushneriv
 * Email: remkwadriga@yandex.ua
 * Date: 18-08-2015
 * Time: 08:25 AM
 */

namespace components;

use yii\rbac\PhpManager;

class AuthManager extends PhpManager
{
    const ROLE_GUEST = 'GUEST';
    const ROLE_USER = 'USER';
    const ROLE_MANAGER = 'MANAGER';
    const ROLE_ADMIN = 'ADMIN';

    public $defaultRoles = [
        self::ROLE_GUEST,
        self::ROLE_USER,
        self::ROLE_MANAGER,
        self::ROLE_ADMIN,
    ];
}