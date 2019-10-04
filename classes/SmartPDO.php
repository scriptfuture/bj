<?php 
namespace classes;

use classes\Utils;
use \PDO;

// Обёртка для быстрой работы с классом PDO
// на основе шаблона проектирования "Одиночка"
class SmartPDO {
    
    protected $connection;
    static private $instance = null;
    
    private function __construct() { }
    private function __clone() { }

    public static function getInstance() {
        if(self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }


    
    private function errorHandler($text) {
        Utils::error($text);
    }
    
    private function OkHandler() {
        echo Utils::ok();
    }
    
    public function connect($errorText = "Database Error!") {
        
        try {
        
            $this->connection = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASSWORD);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->exec("set names utf8");
        
        } catch(PDOException $e) {
            
            $this->errorHandler($errorText);
        }
        
    } 
    
    public function action($prepare_str, $params_arr = [], $res_flag = false, $errorText = "Error adding or editing or deleting a record!") {
        

        try {
    
            $stmt = $this->connection->prepare($prepare_str);
            
            foreach($params_arr as $key => $value) {
                
                $key_arr = explode(":", $key);
                $param_type = PDO::PARAM_INT;
                
                switch ($key_arr[0]) {
                   case "i":
                       $param_type = PDO::PARAM_INT;
                       break;
                   case "s":
                       $param_type = PDO::PARAM_STR;
                       break;
                   case "b":
                       $param_type = PDO::PARAM_BOOL;
                       break;
                }
                
                $stmt->bindValue($key_arr[1], $value, $param_type); 
            }
            
            $stmt->execute();
            
            if($res_flag) {
                return true;
            } else {
                $this->OkHandler();
            }
            

        } catch(PDOException $e) {
            $this->errorHandler($errorText);
        } 

        return false;        
    }
    
    public function read($prepare_str, $params_arr = [], $res_flag = true, $errorText = "Error reading a record!") {

        try {
    
            $stmt = $this->connection->prepare($prepare_str);
            
            foreach($params_arr as $key => $value) {
                
                $key_arr = explode(":", $key);
                $param_type = PDO::PARAM_INT;
                
                switch ($key_arr[0]) {
                   case "i":
                       $param_type = PDO::PARAM_INT;
                       break;
                   case "s":
                       $param_type = PDO::PARAM_STR;
                       break;
                   case "b":
                       $param_type = PDO::PARAM_BOOL;
                       break;
                }
                
                $stmt->bindValue($key_arr[1], $value, $param_type); 
            }
            
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if($res_flag) {
                return $row;
            } else {
                $this->OkHandler();
            }
            

        } catch(PDOException $e) {
            $this->errorHandler($errorText);
        } 

        return false;    
    }

    public function readList($prepare_str, $params_arr = [], $res_flag = true, $errorText = "Error reading a record!") {
       
        try {
    
            $stmt = $this->connection->prepare($prepare_str);
            
            foreach($params_arr as $key => $value) {
                
                $key_arr = explode(":", $key);
                $param_type = PDO::PARAM_INT;
                
                switch ($key_arr[0]) {
                   case "i":
                       $param_type = PDO::PARAM_INT;
                       break;
                   case "s":
                       $param_type = PDO::PARAM_STR;
                       break;
                   case "b":
                       $param_type = PDO::PARAM_BOOL;
                       break;
                }
                
                $stmt->bindValue($key_arr[1], $value, $param_type); 
            }
            
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if($res_flag) {
                return $rows;
            } else {
                $this->OkHandler();
            }
            

        } catch(PDOException $e) {
            $this->errorHandler($errorText);
        } 

        return false; 
       
    }

}