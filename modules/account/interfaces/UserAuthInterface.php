<?php
/**
 * Created by Rem.
 * Author: Dmitry Kushneriv
 * Email: remkwadriga@yandex.ua
 * Date: 12-08-2015
 * Time: 16:05 PM
 */

namespace app\modules\account\interfaces;


interface UserAuthInterface
{
    /**
     * validatePassword
     * @param string $password
     * @return bool
     */
    public function validatePassword($password);

    /**
     * findByUsername
     * @param string $username
     * @return UserAuthInterface
     */
    public static function findByUsername($username);

    /**
     * save
     * @param bool $runValidation
     * @param array $attributeNames
     * @return bool
     */
    public function save($runValidation = true, $attributeNames = null);

    /**
     * setUserName
     * @param string $username
     * @return UserAuthInterface
     */
    public function setUserName($username);

    /**
     * setFirstName
     * @param string $firstName
     * @return UserAuthInterface
     */
    public function setFirstName($firstName);

    /**
     * setLastName
     * @param string $lastName
     * @return UserAuthInterface
     */
    public function setLastName($lastName);

    /**
     * setPassword
     * @param string $password
     * @return UserAuthInterface
     */
    public function setPassword($password);

    /**
     * setPhone
     * @param string $phone
     * @return UserAuthInterface
     */
    public function setPhone($phone);

    /**
     * setInfo
     * @param string $info
     * @return UserAuthInterface
     */
    public function setInfo($info);

    /**
     * addErrors
     * @param array $items
     */
    public function addErrors(array $items);
}