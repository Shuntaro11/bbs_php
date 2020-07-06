<?php

  //データベース接続
  require_once( "../config/dbconnect.php" );
  dbconnection();

  session_start();

  require_once( "../lib/Controller/Check.php" );

  include('./header.php');

?>
 

  <body>
    
    <h1>会員登録確認</h1>
    
    <?php if (count($errors) === 0): ?>
    
    
      <form action="insert_registration.php" method="post">
      
        <p>メールアドレス：<?=htmlspecialchars($email, ENT_QUOTES)?></p>
        <p>名前：<?=htmlspecialchars($user_name, ENT_QUOTES)?></p>
        <p>パスワード：<?=htmlspecialchars($password, ENT_QUOTES)?></p>
        
        <p><input class="btn" type="button" value="戻る" onClick="history.back()"></p>

        <input type="hidden" name="token" value="<?=$_POST['token']?>">
        <p><input class="btn" type="submit" value="登録する"></p>
      
      </form>
    
    <?php elseif(count($errors) > 0): ?>
    
      <?php
      foreach($errors as $value){
        echo "<p class='error-massage'>".$value."</p>";
      }
      ?>
    
      <p><input class="btn" type="button" value="戻る" onClick="history.back()"></p>
    
    <?php endif; ?>
  
  </body>
</html>