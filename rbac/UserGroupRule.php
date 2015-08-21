<?php
/**
 * Created by Rem.
 * Author: Dmitry Kushneriv
 * Email: remkwadriga@yandex.ua
 * Date: 18-08-2015
 * Time: 18:03 PM
 */

namespace rbac;

use Yii;
use abstracts\RbacRuleAbstract;
use components\AuthManager;

class UserGroupRule extends RbacRuleAbstract
{
    public $name = 'user_group_rule';

    /**
     * execute
     * @param int|string $user
     * @param \yii\rbac\Role $item
     * @param array $params
     * @return bool
     */
    public function execute($user, $item, $params)
    {
        $user = Yii::$app->getUser();
        $role = $user->getIsGuest() ? AuthManager::ROLE_GUEST : $user->getIdentity()->role;
        return $role == $item->name || $this->recursiveAccessCheck($role, $item->name);
    }

    /**
     * recursiveAccessCheck
     * @param string $role
     * @param string $child
     * @return bool
     */
    private function recursiveAccessCheck($role, $child)
    {
        $children = Yii::$app->getAuthManager()->getChildren($role);
        if(isset($children[$child])){
            return true;
        }

        foreach(array_keys($children) as $name){
            if($this->recursiveAccessCheck($name, $child)){
                return true;
            }
        }

        return false;
    }
}