<?php
/**
 * Created by Rem.
 * Author: Dmitry Kushneriv
 * Email: remkwadriga@yandex.ua
 * Date: 12-08-2015
 * Time: 15:56 PM
 */

namespace app\modules\account\controllers;

use Yii;
use app\modules\account\abstracts\ControllerAbstract;
use app\modules\account\forms\LoginForm;
use app\modules\account\forms\RegisterForm;

class AuthController extends ControllerAbstract
{
    public function actionRegister()
    {
        $form = new RegisterForm;

        if($form->load($this->post()) && $form->register()){
            Yii::$app->user->login($form->getUser(), Yii::$app->params['userLoginTime']);
            return $this->redirect(['index/index']);
        }

        return $this->render([
            'model' => $form
        ]);
    }

    public function actionLogin()
    {
        $form = new LoginForm();

        if($form->load($this->post()) && $form->login()){
            return $this->redirect(['index/index']);
        }

        return $this->render([
            'model' => $form
        ]);
    }

    public function actionLogout()
    {
        if($this->isPost()){
            Yii::$app->user->logout();
        }

        return $this->redirect(Yii::$app->getHomeUrl());
    }
}