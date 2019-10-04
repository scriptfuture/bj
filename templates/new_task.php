<div class="form-container">
   <h3>Новая задача</h3>
   <br />
   
   <?php if(isset($error)): ?>
   <div class="alert alert-danger" role="alert">
      <?=$error?>
   </div>
   <?php endif;?>
   
    <form class="form-task" method="post" action="/?route=task/new/send">
    
      <div class="form-group">
        <label for="inputUserName">Имя пользователя:</label>
        <input name="user_name" type="text" class="form-control" id="inputUserName" value="<?=$query["user_name"]?>">
      </div>
    
      <div class="form-group">
        <label for="inputEmail">E-mail:</label>
        <input name="email" type="text" class="form-control" id="inputEmail" value="<?=$query["email"]?>">
      </div>
      
   <div class="form-group">
      <label for="text">Текст:</label>
      <textarea name="text" class="form-control" rows="3" id="text"><?=$query["text"]?></textarea>
   </div>
  

      <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
</div>