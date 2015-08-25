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
use rbac\UserGroupRule;
use rbac\CrmRule;

class RbacController extends Controller
{
    private static $_permissions = [
        AuthManager::ROLE_GUEST => [
            'landing' => [
                'index' => [
                    'index',
                ],
                'error' => [
                    'index',
                ],
            ],
            'account' => [
                'index' => [

                ],
                'auth' => [
                    'login',
                    'register',
                ],
            ],
        ],
        AuthManager::ROLE_USER => [
            'role_children' => [AuthManager::ROLE_GUEST],
            'landing' => [
                'index' => [

                ],
                'error' => [

                ],
            ],
            'account' => [
                'index' => [
                    'index',
                ],
                'auth' => [
                    'logout',
                ],
            ],
            'crm' => [
                'company' => [
                    'index',
                    'view',
                    'list',
                    'create',
                    'update',
                ],
            ],
        ],
        AuthManager::ROLE_MANAGER => [
            'role_children' => [AuthManager::ROLE_USER],
            'landing' => [
                'index' => [

                ],
                'error' => [

                ],
            ],
            'account' => [
                'index' => [

                ],
                'auth' => [

                ],
            ],
        ],
        AuthManager::ROLE_ADMIN => [
            'role_children' => [AuthManager::ROLE_MANAGER],
            'landing' => [
                'index' => [

                ],
                'error' => [

                ],
            ],
            'account' => [
                'index' => [

                ],
                'auth' => [

                ],
            ],
        ]
    ];

    private static function getRules()
    {
        return [
            UserGroupRule::className() => [
                'roles' => [
                    AuthManager::ROLE_GUEST,
                    AuthManager::ROLE_USER,
                    AuthManager::ROLE_MANAGER,
                    AuthManager::ROLE_ADMIN,
                ],
            ],
            LandingRule::className() => [
                'modules' => ['landing'],
            ],
            AccountRule::className() => [
                'modules' => ['account'],
            ],
            CrmRule::className() => [
                'modules' => ['crm'],
            ],
        ];
    }

    public function actionInit()
    {
        $authManager = Yii::$app->authManager;
        $authManager->removeAll();

        $rules = [];

        foreach(self::getRules() as $className => $rule){
            $newRule = new $className();
            $authManager->add($newRule);
            $rule['rule'] = $newRule;
            $rules[] = $rule;
        }

        foreach(self::$_permissions as $role => $modules){
            $children = [];

            foreach($modules as $module => $controllers){
                if($module == 'role_children'){
                    foreach($controllers as $roleName){
                        $roles = $authManager->getRoles();
                        if(!isset($roles[$roleName])){
                            $newRole = $authManager->createRole($roleName);
                            $authManager->add($newRole);
                        }
                        $children[] = $roleName;
                    }
                }else{
                    foreach($controllers as $controller => $actions){
                        foreach($actions as $action){
                            $name = $module . '.' . $controller . '.' . $action;
                            $newPermission = $authManager->createPermission($name);
                            foreach($rules as $rulParams){
                                if(isset($rulParams['modules']) && in_array($module, $rulParams['modules'])){
                                    $newPermission->ruleName = $rulParams['rule']->name;
                                }
                            }
                            $authManager->add($newPermission);
                            $children[] = $name;
                        }
                    }
                }
            }

            $roles = $authManager->getRoles();
            if(!isset($roles[$role])){
                $newRole = $authManager->createRole($role);
                $authManager->add($newRole);
            }

            $newRole = $authManager->getRole($role);

            foreach($rules as $rulParams){
                if(isset($rulParams['roles']) && in_array($role, $rulParams['roles'])){
                    $newRole->ruleName = $rulParams['rule']->name;
                }
            }

            $roles = $authManager->getRoles();

            foreach($children as $value){
                $child = isset($roles[$value]) ? $authManager->getRole($value) : $authManager->getPermission($value);
                $authManager->addChild($newRole, $child);
            }
        }
    }
}