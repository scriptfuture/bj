<?php


$path = "classes\\controllers\\";

define('HOMEPAGE', $path."TaskController::tasks");
define('ROUTES', [

    "#^login$#i" => $path."UserController::login",
    "#^exit$#i" => $path."UserController::exit",
       
    "#^tasks$#i" => $path."TaskController::tasks",
    "#^tasks/page/([0-9]+)/sort/([a-z]+)/([0-9a-z_]+)$#i" => $path."TaskController::tasks_page_sort",
       
    "#^task/([0-9]+)$#i" => $path."TaskController::task",
       
    "#^task/new$#i" => $path."TaskController::task_new",
    "#^task/new/ok$#i" => $path."TaskController::task_new_ok",
    "#^task/update/([0-9]+)$#i" => $path."TaskController::task_update",
    "#^task/delete/([0-9]+)$#i" => $path."TaskController::task_delete",
       
    "#^login/send$#i" => $path."UserController::post_login",
       
    "#^task/new/send$#i" => $path."TaskController::post_task_new",
    "#^task/update/send$#i" => $path."TaskController::post_task_update" 
   
]);