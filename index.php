<?php
session_start();
 
//error_reporting(-1);
use classes\App;

// configs
require_once 'configs/db_cfg.php';
require_once 'configs/users_cfg.php';
require_once 'configs/routes_cfg.php';

// autoload
function autoloader($class) {
    
    $class = str_replace("\\", '/', $class);
    $file = __DIR__ . "/{$class}.php";
    if(file_exists($file)) {
        require_once $file;
    }
    
}

spl_autoload_register('autoloader');

// create application
$app  = new App();
$app->create();