
<div class="form-container">
   <h3>Редактирование задачи</h3>
   <br />
   
   <?php if(isset($error)): ?>
   <div class="alert alert-danger" role="alert">
      <?=$error?>
   </div>
   <?php endif;?>
   
    <form class="form-task" method="post" action="/?route=task/update/send">
      <input name="id" type="hidden" value="<?=$task["ID"]?>" />
      

   <div class="form-group">
      <label for="status">Статус (выполнена):</label> &nbsp;
          <input name="status" id="status" type="checkbox" <?php
          if($task["status"] == 1):
              echo "checked";
          else:
              echo "";
          endif;
          ?> />
   </div>
  
      
   <div class="form-group">
      <label for="text">Текст:</label>
      <textarea name="text" class="form-control" rows="3" id="text"><?=$task["text"]?></textarea>
   </div>
  

      <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
</div>