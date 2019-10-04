<?php
namespace classes\controllers;

use classes\SmartPDO;


class UserController {
    
    // GET /login
    public static function login() {
        
        $subtpl = "login.php";
        include("templates/main.php");   
    }
    
    // POST /login
    public static function post_login($query) {
 
        if($query["login"] == SITE_LOGIN && $query["password"] == SITE_PASSWORD) {
            $_SESSION['user_name'] = $query["login"];
            header('Location: /');
            exit();    
        } else {
              
              $error = "Ошибка авторизации";
              
              $subtpl = "login.php";
              include("templates/main.php");   
        } // end if

    }

    // GET /exit
    public static function exit() {
        unset($_SESSION['user_name']);
        header('Location: /');
        exit();
    }

}
 