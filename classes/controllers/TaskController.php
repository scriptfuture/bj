<?php
namespace classes\controllers;

use classes\SmartPDO;
use classes\models\TaskModel;


class TaskController {
    
    // GET /tasks
    public static function tasks() {
        
        $page = 1;
        $sort = 'down';
        $fname = 'ts';
        
        // получаем единственный  экземпляр класса SmartPDO
        $smartPDO = SmartPDO::getInstance();  
        
        $taskModel = new TaskModel($smartPDO);
        $task_arr = $taskModel->getTasks($fname, $sort , $page);
        
        $subtpl = "tasks.php";
        include("templates/main.php");     
        
    }
    
    // GET /tasks/page/:page/sort/:sort/:fname
    public static function tasks_page_sort($page, $sort, $fname) {
        
        // получаем единственный  экземпляр класса SmartPDO
        $smartPDO = SmartPDO::getInstance();  
        
        $taskModel = new TaskModel($smartPDO);
        $task_arr = $taskModel->getTasks($fname, $sort , $page);
        
        $subtpl = "tasks.php";
        include("templates/main.php");         
        
    } 
    
    // GET /task/:id
    public static function task($id) {
        
        // получаем единственный  экземпляр класса SmartPDO
        $smartPDO = SmartPDO::getInstance(); 

        $taskModel = new TaskModel($smartPDO);
        $task = $taskModel->getTask($id);
        
        $subtpl = "task.php";
        include("templates/main.php");     
        
    } 
    
    // GET /task/new
    public static function task_new() {
        
        $subtpl = "new_task.php";
        include("templates/main.php");        
        
    } 
    
    // POST /task/new
    public static function post_task_new($query) {
        
        if(!empty($query["user_name"]) 
            && !empty($query["email"]) 
            && !empty($query["text"]) 
            && filter_var($query["email"], FILTER_VALIDATE_EMAIL) !== false
        ) {
          
            // получаем единственный  экземпляр класса SmartPDO
            $smartPDO = SmartPDO::getInstance();          
           
            $taskModel = new TaskModel($smartPDO);
            if($taskModel->newTask($query["user_name"], $query["email"], $query["text"])) {
                header('Location: /?route=task/new/ok');
                exit(); 
                
            } else {
                
              $error = "Ошибка базы данных";
              
              $subtpl = "new_task.php";
              include("templates/main.php");  
              
            } // end if
    
   
        } else {
              
              $error = "";
              
              if(empty($query["user_name"])) $error .= "Имя пользователя должно быть заполнено!<br />"; 
              if(empty($query["email"])) $error .= "E-mail должен быть заполнен!<br />";  
              if(empty($query["text"])) $error .= "Текст должен быть заполнен!<br />";  
              
              if(!empty($query["email"]) && filter_var($query["email"], FILTER_VALIDATE_EMAIL) === false) $error .= "E-mail заполнен некорректно!<br />"; 
              
              $subtpl = "new_task.php";
              include("templates/main.php");    
        } // end if       
        
    } 
    
    // GET /task/new/ok
    public static function task_new_ok($id) {
        
        $subtpl = "task_new_ok.php";
        include("templates/main.php");   
        
    } 
    
    // GET /task/update/:id
    public static function task_update($id) {
        
        // получаем единственный  экземпляр класса SmartPDO
        $smartPDO = SmartPDO::getInstance(); 

        $taskModel = new TaskModel($smartPDO);
        $task = $taskModel->getTask($id);

        $subtpl = "update_task.php";
        include("templates/main.php");   
        
    } 
    
    // POST /task/update
    public static function post_task_update($query) {
        
        // проверяем на авторизацию
        if(!isset($_SESSION['user_name'])) exit("Access error!");
        
        $queryStatus  = 0;
        if(isset($query["status"]) && $query["status"] === 'on') $queryStatus = 1;
        
        if(!empty($query["id"]) && !empty($query["text"])) {
          
            // получаем единственный  экземпляр класса SmartPDO
            $smartPDO = SmartPDO::getInstance();   


            $taskModel = new TaskModel($smartPDO);
            if($taskModel->updateTask($query["id"], $queryStatus, $query["text"], true)) {
                header('Location: /');
                exit(); 
                
            } else {
                
              $error = "Ошибка базы данных";
              
              $subtpl = "update_task.php";
              include("templates/main.php");  
              
            } // end if
    
   
        } else {
              
              $error = "";
              
              if(empty($query["text"])) $error .= "Текст должен быть заполнен!<br />";  
              
              $task = $query;
              $task["ID"] = $query["id"];
              
              $subtpl = "update_task.php";
              include("templates/main.php");    
        } // end if         
        
    }

    // GET /task/delete/:id
    public static function task_delete($id) {
        
        // получаем единственный  экземпляр класса SmartPDO
        $smartPDO = SmartPDO::getInstance(); 
        
        $taskModel = new TaskModel($smartPDO);
        if($taskModel->deleteTask($id)) {
                header('Location: /');
                exit(); 
                
        } else {
                
           $error = "Ошибка базы данных";
              
           $subtpl = "update_task.php";
           include("templates/main.php");  
              
       } // end if      
        
    }

}