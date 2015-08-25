<?php
/**
 * Created by Rem.
 * Author: Dmitry Kushneriv
 * Email: remkwadriga@yandex.ua
 * Date: 18-08-2015
 * Time: 15:56 PM
 */

namespace landing\controllers;

use Yii;
use landing\abstracts\ControllerAbstract;
use yii\base\Exception;

class ErrorController extends ControllerAbstract
{
    public function actions()
    {
        return [
            /*'index' => [
                'class' => 'yii\web\ErrorAction',
            ],*/
        ];
    }

    public function actionIndex()
    {
        $exception = Yii::$app->errorHandler->exception;
        if($exception->statusCode == 403){
            return $this->redirect(['/account/auth/login']);
        }

        echo '<pre>'; print_r($exception); exit('</pre>');

        return $this->render();
    }
}