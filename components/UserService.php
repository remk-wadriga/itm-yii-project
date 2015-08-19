<?php
/**
 * Created by Rem.
 * Author: Dmitry Kushneriv
 * Email: remkwadriga@yandex.ua
 * Date: 10-08-2015
 * Time: 14:34 PM
 */

namespace components;

use Yii;
use yii\web\User;

/**
 * Class UserService
 * @package app\components
 *
 * @property string $name
 * @property string $role
 */
class UserService extends User
{
    /**
     * getName
     * @return string
     */
    public function getName()
    {
        if($this->getIsGuest()){
            return null;
        }

        $identity = $this->getIdentity();

        $name = $identity->firstName;
        if($identity->lastName){
            $name .= ' ' . $identity->lastName;
        }

        if(!$name){
            $name = $identity->email;
        }

        return $name;
    }
}