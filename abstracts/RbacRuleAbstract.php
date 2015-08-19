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
use yii\rbac\Permission;

abstract class RbacRuleAbstract extends Rule
{
    public function checkRule(Permission $rule)
    {
        return true;
    }
}