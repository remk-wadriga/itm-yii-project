<?php
/**
 * Created by Rem.
 * Author: Dmitry Kushneriv
 * Email: remkwadriga@yandex.ua
 * Date: 21-08-2015
 * Time: 14:16 PM
 */

namespace crm;

use abstracts\ModuleAbstract;

class CrmModule extends ModuleAbstract
{
    public $controllerNamespace = 'crm\controllers';

    public function init()
    {
        parent::init();
    }
}