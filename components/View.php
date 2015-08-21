<?php
/**
 * Created by Rem.
 * Author: Dmitry Kushneriv
 * Email: remkwadriga@yandex.ua
 * Date: 12-08-2015
 * Time: 15:59 PM
 */

namespace components;

use Yii;
use yii\web\View as YiiView;

class View extends YiiView
{
    public function renderFile($viewFile, $params = [], $context = null)
    {
        $controller = Yii::$app->controller;

        if($controller && $controller->hasMethod('getLeftMenuItems')){
            $params['leftMenuItems'] = $controller->getLeftMenuItems();
        }

        return parent::renderFile($viewFile, $params, $context);
    }
}