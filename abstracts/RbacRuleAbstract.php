<?php
/**
 * Created by Rem.
 * Author: Dmitry Kushneriv
 * Email: remkwadriga@yandex.ua
 * Date: 18-08-2015
 * Time: 16:26 PM
 */

namespace abstracts;

use Yii;
use yii\rbac\Rule;
use components\AuthManager;
use yii\rbac\Permission;

abstract class RbacRuleAbstract extends Rule
{
    public function checkRule(Permission $rule)
    {
        $user = Yii::$app->getUser();
        $manager = Yii::$app->getAuthManager();
        $group = $user->getIsGuest() ? AuthManager::ROLE_GUEST : $user->getIdentity()->role;

        $permissions = $manager->getPermissionsByRole($group);
        return isset($permissions[$rule->name]);
    }
}