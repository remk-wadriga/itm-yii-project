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
use yii\web\IdentityInterface;
use interfaces\AuthEventHandlerInterface;

/**
 * Class UserService
 * @package app\components
 *
 * @property string $name
 */
class UserService extends User
{
    const EVENT_SUCCESS_LOGIN = USER_SUCCESS_LOGIN_EVENT;

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

    public function login(IdentityInterface $identity, $duration = 0)
    {
        $result = parent::login($identity, $duration);

        if($result){
            $this->trigger(self::EVENT_SUCCESS_LOGIN);
        }

        return $result;
    }

    public static function afterSuccessLogin($event)
    {
        $handler = $event->sender->identity;
        if($handler instanceof AuthEventHandlerInterface){
            return $handler->afterSuccessLogin();
        }

        return false;
    }
}