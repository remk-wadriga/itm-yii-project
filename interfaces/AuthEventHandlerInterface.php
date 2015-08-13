<?php
/**
 * Created by Rem.
 * Author: Dmitry Kushneriv
 * Email: remkwadriga@yandex.ua
 * Date: 13-08-2015
 * Time: 16:56 PM
 */

namespace interfaces;


interface AuthEventHandlerInterface
{
    /**
     * afterSuccessLogin
     * @return bool
     */
    public function afterSuccessLogin();
}