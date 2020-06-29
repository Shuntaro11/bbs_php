<?php

  //データベース接続
  require_once( "../config/dbconnect.php" );
  dbconnection();
  
  session_start();
 
  require_once( "../lib/Controller/Pre_check.php" );

  if (count($errors) === 0){
	
    $urltoken = hash('sha256',uniqid(rand(),1));
    $url = "http://localhost/bbs_php/public_html/registration_form.php"."?urltoken=".$urltoken;
    
    //ここでpre_usersテーブルに登録する
    try{
      
      require_once( "../lib/Model/Pre_users_registration.php" );

    }catch (PDOException $e){
      print('Error:'.$e->getMessage());
      die();
    }

    // 認証メールを送信
    require_once( "../lib/Functions/send_email.php" );
    
  }

  include('./header.php');

?>

  <body>
    <?php if (count($errors) === 0): ?>
      <h1>認証メール</h1>
      <p><?=$message?></p>
    <?php elseif(count($errors) > 0): ?>
      <h1>認証メールを送信できません</h1>
      <?php
      foreach($errors as $value){
        echo "<p class='error-massage'>".$value."</p>";
      }
      ?>
      <input class="btn" type="button" value="戻る" onClick="history.back()">
    <?php endif; ?>
    <p><a class="btn" href="index.php">ホーム</a></p>
  </body>
</html>