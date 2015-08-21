<?php

namespace landing;

use abstracts\ModuleAbstract;

class LandingModule extends ModuleAbstract
{
    public $controllerNamespace = 'landing\controllers';

    public function init()
    {
        parent::init();
    }
}
