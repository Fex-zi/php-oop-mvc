<?php

namespace models\admin;
use models\find\Find;
use models\traits\LoginTrait;

class Auth extends Find{
    
    use LoginTrait;

    public function isAdmin(){
        return isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true;
    }

    public function showLogin(){
        include __DIR__ .'/../../views/admin/login.php';
    }

    public function show404(){
        include __DIR__ .'/../../views/status-pages/404.php';
    }

    public function loginAdmin($username = null, $password = null){
        return $this->doLogin($username, $password, 1);
    }

}
