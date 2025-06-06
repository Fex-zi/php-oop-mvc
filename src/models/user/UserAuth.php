<?php

namespace models\user;
use models\find\Find;
use models\traits\LoginTrait;

class UserAuth extends Find{
    
    use LoginTrait;

    public function isUser(){
        return isset($_SESSION['is_user']) && $_SESSION['is_user'] === true;
    }

    public function showLogin(){
        include __DIR__ .'/../../views/profile/login.php';
    }

    public function show404(){
        include __DIR__ .'/../../views/status-pages/404.php';
    }

    public function loginUser($username = null, $password = null){
        return $this->doLogin($username, $password, 0);
    }

}
