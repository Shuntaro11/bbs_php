<?php
  
  //データベース接続
  require_once( "../config/dbconnect.php" );
  dbconnection();
  
  session_start();
 
  //クロスサイトリクエストフォージェリ（CSRF）対策
  $_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
  $token = $_SESSION['token'];
  
  //エラーメッセージの初期化
  $errors = array();
 
  if(empty($_GET)) {
    header("Location: pre_registration_form.php");
    exit();
  }else{
    //GETデータを変数に入れる
    $urltoken = isset($_GET[urltoken]) ? $_GET[urltoken] : NULL;

    //メール入力判定
    if ($urltoken == ''){
      $errors['urltoken'] = "もう一度登録をやりなおして下さい。";
    }else{
      try{
        
        //flagが0の未登録者・仮登録日から24時間以内
        $stmt = $pdo->prepare("SELECT * FROM pre_users WHERE urltoken=(:urltoken) AND flag =0 AND date > now() - interval 24 hour");
        $stmt->bindValue(':urltoken', $urltoken, PDO::PARAM_STR);
        $stmt->execute();
        
        //レコード件数取得
        $row_count = $stmt->rowCount();
        
        //24時間以内に仮登録され、本登録されていないトークンの場合
        if( $row_count === 1){

          $user = $stmt->fetch();

          $encrypted_email = $user[email];
          $encrypted_password = $user[password];

          // 仮登録したアドレスとパスワードを復号化
          $method = 'aes-256-cbc';
          $password = openssl_decrypt($encrypted_password, $method, KEY);
          $email = openssl_decrypt($encrypted_email, $method, KEY);
          $_SESSION['email'] = $email;

          $user_name = $user[user_name];
          
        }else{
          $errors['urltoken_timeover'] = "このURLはご利用できません。有効期限が過ぎた等の問題があります。もう一度登録をやりなおして下さい。";
        }
        
        //データベース接続切断
        $pdo = null;
        
      }catch (PDOException $e){
        print('Error:'.$e->getMessage());
        die();
      }
    }
  }

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