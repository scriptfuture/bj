<?php 
namespace classes;

use classes\Utils;
use \PDO;
use classes\controllers\TariffController;

// Router - навигация по приложению
class Router {
    
    static $routes = [];
    
    static $currentMethod = NULL;
    static $currentRoute = NULL;
    static $currentQuery = [];
    

    static function start() {
        
        // сохраняем массив с роутами
        self::$routes = ROUTES;
        
        self::$currentMethod = $_SERVER["REQUEST_METHOD"];
        
        if(isset($_GET["route"])) {
           self::$currentRoute = $_GET["route"];
            
           if(self::$currentMethod === "POST") { 
               self::$currentQuery = $_POST;
           } else {
               self::$currentQuery = $_GET;
           }
        } else {
           self::$currentRoute = "/";
        } // end if

        if(self::$currentRoute === "/") {
            
            $homepage = HOMEPAGE;
            $homepage();
            
        } else {

            // вызоваяем котроллеры
            if(!empty(self::$routes)) {
                foreach(self::$routes as $key => $value) {

                    if(preg_match($key, self::$currentRoute, $list)) { 
                        unset($list[0]);
                        array_push($list, self::$currentQuery);
                        call_user_func_array($value, $list);
                    
                        break;
                    } 
                }
            } // end if
        
        } // end if


    }

}