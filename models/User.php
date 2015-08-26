<?php

namespace models;

use Yii;
use abstracts\ModelAbstract;
use yii\web\IdentityInterface;
use account\interfaces\UserAuthInterface;
use yii\web\UserEvent;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $email
 * @property string $password_hash
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @property string $reg_date
 * @property string $last_visit_date
 * @property string $role
 * @property string $status
 * @property string $info
 *
 * @property string $passwordHash
 * @property string $firstName
 * @property string $lastName
 * @property string $fullName
 * @property string $regDate
 * @property string $lastVisitDate
 * @property string $password
 */
class User extends ModelAbstract implements IdentityInterface, UserAuthInterface
{
    private static $_items;

    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            [['email', 'password_hash', 'reg_date'], 'required'],
            [['reg_date', 'last_visit_date', 'regDate', 'lastVisitDate'], 'safe'],
            [['role', 'status', 'info'], 'string'],
            [['email'], 'string', 'max' => 70],
            [['password_hash', 'password', 'passwordHash'], 'string', 'max' => 128],
            [['first_name', 'last_name', 'firstName', 'lastName'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 36]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'passwordHash' => 'Password Hash',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'phone' => 'Phone',
            'regDate' => 'Reg Date',
            'lastVisitDate' => 'Last Visit Date',
            'role' => 'Role',
            'status' => 'Status',
            'info' => 'Info',
        ];
    }

    // Depending

    // END Depending


    // Event handlers

    public static function afterSuccessLogin(UserEvent $event)
    {
        $id = $event->identity->getId();
        $dateTime = Yii::$app->timeService->getCurrentDateTime();
        return Yii::$app->db->createCommand()->update(self::tableName(), ['last_visit_date' => $dateTime], ['id' => $id])->execute();
    }

    // END Event handlers


    // Getters and setters

    // password
    public function setPassword($val)
    {
        if ($this->regDate === null) {
            $this->regDate = Yii::$app->timeService->getCurrentDateTime();
        }
        $this->passwordHash = $this->createPasswordHash($val);
    }
    public function getPassword()
    {
        return $this->password_hash;
    }

    // passwordHash
    public function setPasswordHash($val)
    {
        $this->password_hash = $val;
    }
    public function getPasswordHash()
    {
        return $this->password_hash;
    }

    // firstName
    public function setFirstName($val)
    {
        $this->first_name = $val;
    }
    public function getFirstName()
    {
        return $this->first_name;
    }

    // lastName
    public function setLastName($val)
    {
        $this->last_name = $val;
    }
    public function getLastName()
    {
        return $this->last_name;
    }

    // lastVisitDate
    public function setLastVisitDate($val)
    {
        $this->last_visit_date = $val;
    }
    public function getLastVisitDate()
    {
        return $this->last_visit_date;
    }

    // regDate
    public function setRegDate($val)
    {
        $this->reg_date = $val;
    }
    public function getRegDate()
    {
        return $this->reg_date;
    }

    public function getFullName()
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    // END Getters and setters


    // Public methods

    // END Public methods


    // Protected methods

    protected function createPasswordHash($password)
    {
        return hash(Yii::$app->params['crypt_alo'], $password . $this->regDate . Yii::$app->params['salt']);
    }


    protected static function getItemsNames()
    {
        return [
            'id',
            'name' => 'CONCAT_WS(\' \', `first_name`, `last_name`)',
        ];
    }

    // END Protected methods


    // Implements IdentityInterface

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {

    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {

    }

    public function validateAuthKey($authKey)
    {

    }

    // END Implements IdentityInterface


    // Implements UserAuthInterface

    /**
     * validatePassword
     * @param string $password
     * @return bool
     */
    public function validatePassword($password)
    {
        return $this->createPasswordHash($password) === $this->passwordHash;
    }

    /**
     * findByUsername
     * @param string $username
     * @return UserAuthInterface
     */
    public static function findByUsername($username)
    {
        return self::findOne(['email' => $username]);
    }

    /**
     * setUserName
     * @param string $username
     * @return $this
     */
    public function setUserName($username)
    {
        $this->email = $username;
        return $this;
    }

    /**
     * setPhone
     * @param string $phone
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * setInfo
     * @param string $info
     * @return $this
     */
    public function setInfo($info)
    {
        $this->info = $info;
        return $this;
    }

    // END Implements UserAuthInterface
}
