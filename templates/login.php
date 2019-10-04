<div class="form-container">
   <h3>Авторизация</h3>
   <br />
   
   <?php if(isset($error)): ?>
   <div class="alert alert-danger" role="alert">
      <?=$error?>
   </div>
   <?php endif;?>
   
    <form class="login" method="post" action="/?route=login/send">
      <div class="form-group">
        <label for="inputLigin">Логин</label>
        <input name="login" type="text" class="form-control" id="inputLigin" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="inputPassword">Пароль</label>
        <input name="password" type="password" class="form-control" id="inputPassword">
      </div>
      <button type="submit" class="btn btn-primary">Войти</button>
    </form>
</div>