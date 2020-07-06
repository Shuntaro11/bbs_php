<?php

  //データベース接続
  require_once( "../config/dbconnect.php" );
  dbconnection();

  session_start();

  require_once( "../lib/Controller/Insert_registration.php" );

  include('./header.php');

?>

  <body>
  
    <?php if (count($errors) === 0): ?>

      <h1>会員登録完了</h1>
      
      <p>登録完了いたしました。</p>
      <p><a href=""></a></p>
      
    <?php elseif(count($errors) > 0): ?>
      
      <?php
      foreach($errors as $value){
        echo "<p class='error-massage'>".$value."</p>";
      }
      ?>
    
    <?php endif; ?>
  
  </body>
</html>