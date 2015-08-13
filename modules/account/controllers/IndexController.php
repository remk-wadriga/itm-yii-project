<?php

namespace app\modules\account\controllers;

use app\modules\account\abstracts\ControllerAbstract;

class IndexController extends ControllerAbstract
{
    public function actionIndex()
    {
        return $this->render();
    }
}
