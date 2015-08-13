<?php
/**
 * Created by Rem.
 * Author: Dmitry Kushneriv
 * Email: remkwadriga@yandex.ua
 * Date: 12-08-2015
 * Time: 16:18 PM
 */

namespace app\modules\account\forms;

use Yii;
use app\abstracts\FormAbstract;
use app\modules\account\interfaces\UserAuthInterface;

class RegisterForm extends FormAbstract
{
    public $username;
    public $firstName;
    public $lastName;
    public $phone;
    public $info;
    public $password;
    public $retypePassword;

    /**
     * @var \yii\web\IdentityInterface|UserAuthInterface
     */
    private $_user;

    public function rules()
    {
        return [
            [['username', 'password', 'retypePassword'], 'required'],
            ['retypePassword', 'compare', 'compareAttribute' => 'password'],
            [['password', 'retypePassword'], 'string', 'min' => 3, 'max' => 255],
            [['username'], 'email'],
            [['username', 'firstName', 'lastName'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 126],
            [['info'], 'string', 'max' => 64000],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Email',
            'password' => 'Password',
            'firstName' => 'First name',
            'lastName' => 'Last name',
            'phone' => 'Phone',
            'about' => 'About me',
            'weight' => 'Weight',
        ];
    }

    /**
     * register
     * @return bool
     */
    public function register()
    {
        $user = $this->createUser();

        if(!$this->validate()){
            $user->addErrors($this->getErrors());
            return false;
        }

        $user
            ->setUserName($this->username)
            ->setFirstName($this->firstName)
            ->setLastName($this->lastName)
            ->setPhone($this->phone)
            ->setInfo($this->info)
            ->setPassword($this->password);

        $result = $user->save();
        if($result){
            $this->_user = $user;
        }

        return $result;
    }

    /**
     * getUserClass
     * @return string
     */
    public function getUserClass()
    {
        return Yii::$app->user->identityClass;
    }

    /**
     * getUser
     * @return \yii\web\IdentityInterface|UserAuthInterface|null
     */
    public function getUser()
    {
        if($this->_user !== null){
            return $this->_user;
        }

        $class = $this->getUserClass();
        return $this->_user = $class::findByUserName($this->username);
    }

    /**
     * createUser
     * @return mixed
     */
    private function createUser()
    {
        $class = $this->getUserClass();
        return new $class();
    }
}