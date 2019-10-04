<div class="content-container"><div>
<h3>Задачи</h3>

<div class="select-sort">
    <div class="btn-group">
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Сортировка по &nbsp;<span class="caret"></span></button>
      <ul class="dropdown-menu" role="menu">
      
      <?php 
      $farr = array("user_name" => "имени", "email" => "e-mail", "status" => "статусу", "admin_edit" => "отред. адм.", "ts" => "дате и времени");
      foreach($farr as $key => $value):
          if($key == $fname):
              echo '<li class="active"><a href="/?route=tasks/page/'.$page.'/sort/'.$sort.'/'.$key.'">'.$value.'</a></li>';
          else:
              echo '<li><a href="/?route=tasks/page/'.$page.'/sort/'.$sort.'/'.$key.'">'.$value.'</a></li>';
          endif;
      endforeach;
      ?>
        
      </ul>
    </div>

    <div class="btn-group">
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Упорядочить по &nbsp;<span class="caret"></span></button>
      <ul class="dropdown-menu" role="menu">
      
      <?php 
      $sarr = array("up" => "возростанию", "down" => "убыванию");
      foreach($sarr as $key => $value):
          if($key == $sort):
              echo '<li class="active"><a href="/?route=tasks/page/'.$page.'/sort/'.$key.'/'.$fname.'">'.$value.'</a></li>';
          else:
              echo '<li><a href="/?route=tasks/page/'.$page.'/sort/'.$key.'/'.$fname.'">'.$value.'</a></li>';
          endif;
      endforeach;
      ?>
      
      </ul>
    </div>
</div>

<div class="task-conteiner">
    
    <?php foreach($task_arr["tasks"] as $key => $value):?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="task-head">
            <span class="user-name"><?=$value["user_name"]?></span> 
            <span class="email"><?=$value["email"]?></span> &nbsp;
      
<?php if($value["status"] == 1):?>
<span class="label label-success">Выполнена</span>
<?php else:?>
<span class="label label-default">В разработке</span>
<?php endif;?>

           <?php if($value["admin_edit"] == 1):?>
           <span class="label label-danger">Отредактировано администратором</span>
           <?php endif;?>
   
            <span class="dt pull-right"><?=$value["ts"]?></span></div>
      </div>
      <div class="panel-body">
         <?=$value["text"]?>

        <div class="task-btn-block">
        
            <div class="pull-left"><button type="button" class="btn btn-default" onClick=<?='"window.location = \'/?route=task/'.$value["ID"].'\'"'?>><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp; Подробнее</button></div>
            
            <div class="pull-right">
            
              <?if(isset($_SESSION['user_name'])):?>
                <button type="button" class="btn btn-primary" onClick=<?='"window.location = \'/?route=task/update/'.$value["ID"].'\'"'?>><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp; Редактировать</button>
                
                <button type="button" class="btn btn-danger" onClick=<?='"window.location = \'/?route=task/delete/'.$value["ID"].'\'"'?>><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Удалить</button>
              <?endif;?>

            </div>
        
        </div>

      </div>
    </div>
    <?php endforeach; ?>

</div>

<ul class="pagination">
  <?php
  
  if($task_arr["isPagination"]) { 
      for($i=1;$i<=$task_arr["num_pages"];$i++){

          if($i == $page):
             echo '<li class="active"><a href="/?route=tasks/page/'.$i.'/sort/'.$sort.'/'.$fname.'">'.$i.'</a></li>';
          else:
             echo '<li><a href="/?route=tasks/page/'.$i.'/sort/'.$sort.'/'.$fname.'">'.$i.'</a></li>';
          endif;
      }
  } 
   ?>

</ul>

</div>
