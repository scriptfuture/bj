<?php

use classes\Router;

$menu = array("task/new" => "Создать задачу","tasks" => "Задачи");

if(!isset($_SESSION['user_name'])) $menu["login"] = "Авторизация";

$str_menu = '';
$active = '';

foreach($menu as $key => $value) {
    if(Router::$currentRoute == $key) $active = 'class="active"'; else $active = '';
    $str_menu .= '<li '.$active.'><a href="/?route='.$key.'">'.$value.'</a></li>';

} // end foreach

?>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="/"><div class="logo"></div></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav pull-left">
            <?=$str_menu?>
          </ul>
		  
          <?if(isset($_SESSION['user_name'])):?>
          <ul class="nav navbar-nav pull-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			    <span class="glyphicon glyphicon-user"></span> <?=$_SESSION['user_name']?> </a>
              <ul class="dropdown-menu">
                <li><a href="/?route=exit">Выход</a></li>
              </ul>
            </li>
          </ul>
          <?endif;?>
        </div><!--/.nav-collapse -->
      </div>
    </nav>