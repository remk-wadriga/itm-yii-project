<?php
/**
 * Created by Rem.
 * Author: Dmitry Kushneriv
 * Email: remkwadriga@yandex.ua
 * Date: 21-08-2015
 * Time: 14:28 PM
 */

namespace rbac;

use Yii;
use abstracts\RbacRuleAbstract;

class CrmRule extends RbacRuleAbstract
{
    public $name = 'crm_rule';

    /**
     * execute
     * @param int|string $user
     * @param \yii\rbac\Permission $item
     * @param array $params
     * @return bool
     */
    public function execute($user, $item, $params)
    {
        if (!$this->checkRule($item)) {
            return false;
        }

        return true;
    }
}