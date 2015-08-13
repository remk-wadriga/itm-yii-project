<?php
/**
 * Created by Rem.
 * Author: Dmitry Kushneriv
 * Email: remkwadriga@yandex.ua
 * Date: 12-08-2015
 * Time: 17:34 PM
 */

namespace app\abstracts;

use yii\web\AssetBundle;

class AssetAbstract extends AssetBundle
{
    public function init()
    {
        parent::init();
        $classParts = explode('\\', self::className());
        $className = strtolower(str_replace('Asset', '', end($classParts)));

        $this->sourcePath = '@webroot/' . $className;
    }
}