<?php
/**
 * Created by Rem.
 * Author: Dmitry Kushneriv
 * Email: remkwadriga@yandex.ua
 * Date: 18-08-2015
 * Time: 08:30 AM
 */

namespace rbac;

use Yii;
use yii\rbac\Rule;
use components\AuthManager;

class UserGroupRule extends Rule
{
    public $name = 'userGroup';

    public function execute($user, $item, $params)
    {
        if (!Yii::$app->user->isGuest) {
            $group = Yii::$app->user->identity->role;

            switch($item->name){
                case AuthManager::ROLE_ADMIN:
                    return $group == AuthManager::ROLE_ADMIN;
                    break;
                case AuthManager::ROLE_MANAGER:
                    return $group == AuthManager::ROLE_MANAGER;
                    break;
                default:
                    return $group == AuthManager::ROLE_USER;
                    break;
            }
        }

        return true;
    }
}