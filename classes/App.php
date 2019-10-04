<?php 
namespace classes;

use classes\{Utils, SmartPDO, Router};
use classes\models\ModelTarif;

class App {
    
    public function create() {
        
        // создаём единственный  экземпляр класса SmartPDO
        $smartPDO = SmartPDO::getInstance();
        
        // подключаемся к базе данных
        $smartPDO->connect();
        
        // запускаем Router
        Router::start();     

        
    }
}