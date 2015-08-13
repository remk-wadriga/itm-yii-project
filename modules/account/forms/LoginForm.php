<?php

namespace app\modules\account\forms;

use Yii;
use app\abstracts\FormAbstract;
use app\modules\account\interfaces\UserAuthInterface;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends FormAbstract
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['rememberMe'], 'boolean'],
            [['password'], 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? Yii::$app->params['userLoginTime'] : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return \yii\web\IdentityInterface|UserAuthInterface|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $class = Yii::$app->user->identityClass;
            if(class_exists($class)){
                $this->_user = $class::findByUsername($this->username);
            }
        }

        return $this->_user;
    }
}
