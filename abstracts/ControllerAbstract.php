<?php
/**
 * Created by Rem.
 * Author: Dmitry Kushneriv
 * Email: remkwadriga@yandex.ua
 * Date: 10-08-2015
 * Time: 13:09 PM
 */

namespace app\abstracts;

use Yii;
use yii\web\Controller;

abstract class ControllerAbstract extends Controller
{
    /**
     * render
     * @param null $view
     * @param array $params
     * @return string
     */
    public function render($view = null, $params = [])
    {
        if(is_array($view)){
            $params = $view;
            $view = null;
        }

        if($view === null){
            $view = $this->action->id;
        }

        return parent::render($view, $params);
    }

    public function getViewPath()
    {
        $module = $this->module->id;

        if($module === Yii::$app->id){
            return parent::getViewPath();
        }

        return Yii::getAlias('@app') . '/views/' . $module . '/' . $this->id;
    }

    public function isPost()
    {
        return Yii::$app->request->getIsPost();
    }

    public function isAjax()
    {
        return Yii::$app->request->getIsAjax();
    }

    public function post($param = null, $default = null)
    {
        return Yii::$app->request->post($param, $default);
    }

    public function get($param = null, $default = null)
    {
        return Yii::$app->request->get($param, $default);
    }
}