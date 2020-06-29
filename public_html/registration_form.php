<?php
  
  //データベース接続
  require_once( "../config/dbconnect.php" );
  dbconnection();
  
  session_start();
 
  require_once( "../lib/Controller/Registration_form.php" );

  include('./header.php');
  
?>

  <body>

    <h1>会員登録</h1>
    <?php if (count($errors) === 0): ?>

      <form action="check.php" method="post">
        <label>メールアドレス<label>
        <p><?=htmlspecialchars($email, ENT_QUOTES, 'UTF-8')?></p>

        <label>名前<label>
        <p><input type="text" name="user_name" id="name" size="20" onblur="judgeName()" value="<?=$user_name?>"></p>
        <p class="error-massage" id="name_error"></p>

        <label>パスワード<label>
        <p><input type="text" name="password" id="password" size="20" onblur="judgePassword()" value="<?=$password?>"></p>
        <p class="error-massage" id="password_error"></p>

        <input type="hidden" name="token" value="<?=$token?>">
        <input class="btn" type="submit" value="確認">
      </form>

    <?php elseif(count($errors) > 0): ?>
    
      <?php
      foreach($errors as $value){
        echo "<p class='error-massage'>".$value."</p>";
      }
      ?>
      
    <?php endif; ?>

    <script type="text/javascript" src="./js/form_validation.js"></script>

  </body>
</html>