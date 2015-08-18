<?php
/**
 * Created by Rem.
 * Author: Dmitry Kushneriv
 * Email: remkwadriga@yandex.ua
 * Date: 18-08-2015
 * Time: 17:12 PM
 */

namespace rbac;

use Yii;
use abstracts\RbacRuleAbstract;

class LandingRule extends RbacRuleAbstract
{
    public $name = 'landing_rule';

    /**
     * execute
     * @param int|string $user
     * @param \abstracts\RbacRuleAbstract $item
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