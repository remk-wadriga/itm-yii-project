<?php
/**
 * Created by Rem.
 * Author: Dmitry Kushneriv
 * Email: remkwadriga@yandex.ua
 * Date: 21-08-2015
 * Time: 14:22 PM
 */

namespace crm\controllers;

use Yii;
use crm\abstracts\ControllerAbstract;

class CompanyController extends ControllerAbstract
{
    public function actionIndex()
    {

    }

    public function actionList()
    {
        return $this->render();
    }
}