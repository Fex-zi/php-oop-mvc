<?php

namespace models\admin;
use models\find\Find;

class Auth extends Find{

    public function isAdmin(){
        return isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true;
    }

    public function showLogin(){
        include __DIR__ .'/../../views/admin/login.php';
    }

    public function show404(){
        include __DIR__ .'/../../views/status-pages/404.php';
    }

    public function doLogin($username, $password){
        if($_POST['action'] ==='login'){
        $username = $_POST['email'];
        $password = $_POST['password'];


        }
    }
}
 