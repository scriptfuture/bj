<?php
namespace classes\models;

use classes\{Utils, SmartPDO};

class TaskModel {
    
    private $spdo = NULL;
    
    public function __construct() { 
    
        // получаем единственный  экземпляр класса SmartPDO
        $this->spdo = SmartPDO::getInstance();
    
    }
    
    // получем список задач
    public function getTasks($sort_f = 'ts', $vector = 'up', $page = 0, $per_page = 3) {
        
        // получаем номер страницы
        if ($page > 0) $page--;
        
        // вычисляем первый оператор для LIMIT
        $start=abs($page*$per_page);
        
        // поропускаем заранее определённые строки
        $order = "ASC";
        if($vector === "down") $order = "DESC";
        
        if (!in_array($sort_f, array("ID","user_name", "email", "status", "admin_edit",'ts'))) {
            $sort_f = 'ts';
        }
        
        // получаем общие кол-во задач
        $total_rows = $this->spdo->read("SELECT COUNT(*) AS count FROM tasks")["count"];
        $num_pages = ceil($total_rows/$per_page);
        
        // получаем список задач
        $tasks = $this->spdo->readList("SELECT *, LEFT(text, 580) as text FROM tasks ORDER BY ".$sort_f." ".$order. " LIMIT ?,?" , 
        ["i:1" => $start, "i:2" => $per_page]);
        
        $isPagination = false;
        if($total_rows > $per_page) $isPagination = true;

   
        return ["tasks" => $tasks, "num_pages" => $num_pages, "isPagination" => $isPagination];
    }
    
    // получем конкретную задачу
    public function getTask($id) {
        return $this->spdo->read("SELECT * FROM tasks WHERE ID = ?" , ["i:1" => $id]);
    }
    
    // записываем в базу новую задачу
    public function newTask($user_name, $email, $text) {
        
        $user_name =  htmlspecialchars($user_name);
        $email = htmlspecialchars($email);
        $text = htmlspecialchars($text);

        return $this->spdo->action("INSERT INTO tasks (user_name, email, text) VALUES (?,?,?)", 
                                     ["s:1" => $user_name, "s:2" => $email, "s:3" => $text], true);
    }
    
    // обновляем задачу в базе данных
    public function updateTask($id, $status, $text) {
        
        $text = htmlspecialchars($text);
        
        $row = $this->spdo->read("SELECT * FROM tasks WHERE ID = ?" , ["i:1" => $id]);
        
        $admin_edit = $row["admin_edit"];
        if($row["text"] !== $text) $admin_edit = 1;

        return $this->spdo->action("UPDATE tasks
           SET 
              text = ?, status = ?, admin_edit = ?
           WHERE ID = ?", ["s:1" => $text, "i:2" => $status, "i:3" => $admin_edit, "i:4" => $id], true);
    }
    
    // удаляем задачу из базе данных
    public function deleteTask($id) {
        return $this->spdo->action("DELETE FROM tasks WHERE ID = ?", ["i:1" => $id], true);
    }
    
    
}