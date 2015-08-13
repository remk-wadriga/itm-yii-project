<?php

namespace account\controllers;

use account\abstracts\ControllerAbstract;

class IndexController extends ControllerAbstract
{
    public function actionIndex()
    {
        return $this->render();
    }
}
