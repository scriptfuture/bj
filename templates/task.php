<?php
    use classes\Utils;
?>
<div class="content-container">
 <div class="panel panel-default">
      <div class="panel-heading">
        <div class="task-head">
            <span class="user-name"><?=$task["user_name"]?></span> 
            <span class="email"><?=$task["email"]?></span> &nbsp;
      
<?php if($task["status"] == 1):?>
<span class="label label-success">Выполнена</span>
<?php else:?>
<span class="label label-default">В разработке</span>
<?php endif;?>

           <?php if($task["admin_edit"] == 1):?>
           <span class="label label-danger">Отредактировано администратором</span>
           <?php endif;?>
   
            <span class="dt pull-right"><?=$task["ts"]?></span></div>
      </div>
      <div class="panel-body">
         <?=Utils::text_to_html($task["text"])?>

      </div>
    </div>
</div>