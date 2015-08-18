<?php
/**
 * Created by Rem.
 * Author: Dmitry Kushneriv
 * Email: remkwadriga@yandex.ua
 * Date: 18-08-2015
 * Time: 08:29 AM
 */

namespace app\commands;

use Yii;
use yii\console\Controller;
use rbac\UserGroupRule;
use components\AuthManager;

class RbacController extends Controller
{
    public function actionInit()
    {
        $authManager = Yii::$app->authManager;

        // Create roles
        $guest = $authManager->createRole(AuthManager::ROLE_GUEST);
        $user = $authManager->createRole(AuthManager::ROLE_USER);
        $manager = $authManager->createRole(AuthManager::ROLE_MANAGER);
        $admin = $authManager->createRole(AuthManager::ROLE_ADMIN);

        // Create simple, based on action{$NAME} permissions
        $login  = $authManager->createPermission('login');
        $logout = $authManager->createPermission('logout');
        $error  = $authManager->createPermission('error');
        $signUp = $authManager->createPermission('register');
        $index  = $authManager->createPermission('index');
        $list  = $authManager->createPermission('list');
        $view   = $authManager->createPermission('view');
        $update = $authManager->createPermission('update');
        $delete = $authManager->createPermission('delete');

        // Add permissions in Yii::$app->authManager
        $authManager->add($login);
        $authManager->add($logout);
        $authManager->add($error);
        $authManager->add($signUp);
        $authManager->add($index);
        $authManager->add($list);
        $authManager->add($view);
        $authManager->add($update);
        $authManager->add($delete);

        // Add rule, based on UserExt->group === $user->group
        $userGroupRule = new UserGroupRule();
        $authManager->add($userGroupRule);

        // Add rule "UserGroupRule" in roles
        $guest->ruleName  = $userGroupRule->name;
        $user->ruleName  = $userGroupRule->name;
        $manager->ruleName = $userGroupRule->name;
        $admin->ruleName  = $userGroupRule->name;

        // Add roles in Yii::$app->authManager
        $authManager->add($guest);
        $authManager->add($user);
        $authManager->add($manager);
        $authManager->add($admin);

        // Add permission-per-role in Yii::$app->authManager
        // GUEST
        $authManager->addChild($guest, $login);
        $authManager->addChild($guest, $logout);
        $authManager->addChild($guest, $error);
        $authManager->addChild($guest, $signUp);
        $authManager->addChild($guest, $index);
        $authManager->addChild($guest, $list);
        $authManager->addChild($guest, $view);

        // USER
        $authManager->addChild($user, $update);
        $authManager->addChild($user, $guest);

        // MANAGER
        $authManager->addChild($manager, $update);
        $authManager->addChild($manager, $user);

        // ADMIN
        $authManager->addChild($admin, $delete);
        $authManager->addChild($admin, $manager);
    }
}