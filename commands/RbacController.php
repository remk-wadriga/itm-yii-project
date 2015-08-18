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
use components\AuthManager;
use rbac\AccountRule;
use rbac\LandingRule;

class RbacController extends Controller
{
    public function actionInit()
    {
        $authManager = Yii::$app->authManager;

        // Create roles
        $guest  = $authManager->createRole(AuthManager::ROLE_GUEST);
        $user  = $authManager->createRole(AuthManager::ROLE_USER);
        $manager = $authManager->createRole(AuthManager::ROLE_MANAGER);
        $admin  = $authManager->createRole(AuthManager::ROLE_ADMIN);

        $authManager->add($guest);
        $authManager->add($user);
        $authManager->add($manager);
        $authManager->add($admin);

        // Account module rules
        $accountRule = new AccountRule();
        $authManager->add($accountRule);

        $accountIndexIndex = $authManager->createPermission('account.index.index');
        $accountAuthRegister = $authManager->createPermission('account.auth.register');
        $accountIndexLogin = $authManager->createPermission('account.auth.login');
        $accountIndexLogout = $authManager->createPermission('account.auth.logout');

        $accountIndexIndex->ruleName = $accountRule->name;
        $accountAuthRegister->ruleName = $accountRule->name;
        $accountIndexLogin->ruleName = $accountRule->name;
        $accountIndexLogout->ruleName = $accountRule->name;

        $authManager->add($accountIndexIndex);
        $authManager->add($accountAuthRegister);
        $authManager->add($accountIndexLogin);
        $authManager->add($accountIndexLogout);

        // Landing module rules
        $landingRule = new LandingRule();
        $authManager->add($landingRule);

        $landIndexIndex = $authManager->createPermission('landing.index.index');
        $landErrorIndex = $authManager->createPermission('landing.error.index');

        $landIndexIndex->ruleName = $landingRule->name;
        $landErrorIndex->ruleName = $landingRule->name;

        $authManager->add($landIndexIndex);
        $authManager->add($landErrorIndex);


        // GUEST permissions
        //  account
        $authManager->addChild($guest, $accountIndexLogin);
        $authManager->addChild($guest, $accountAuthRegister);
        //  landing
        $authManager->addChild($guest, $landIndexIndex);
        $authManager->addChild($guest, $landErrorIndex);

        // USER permissions
        $authManager->addChild($user, $guest);
        //  account
        $authManager->addChild($user, $accountIndexIndex);
        $authManager->addChild($user, $accountIndexLogout);

        // MANAGER permissions
        $authManager->addChild($manager, $user);

        // ADMIN permissions
        $authManager->addChild($admin, $manager);
    }
}