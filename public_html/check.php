<?php

  //データベース接続
  require_once( "../config/dbconnect.php" );
  dbconnection();

  session_start();

  //クロスサイトリクエストフォージェリ（CSRF）対策のトークン判定
  if ($_POST['token'] != $_SESSION['token']){
    echo "不正アクセスの可能性あり";
    exit();
  }
 
  //前後にある半角全角スペースを削除する関数
  function spaceTrim ($str) {
    // 行頭
    $str = preg_replace('/^[ 　]+/u', '', $str);
    // 末尾
    $str = preg_replace('/[ 　]+$/u', '', $str);
    return $str;
  }
 
  //エラーメッセージの初期化
  $errors = array();
  
  if(empty($_POST)) {

    header("Location: pre_registration_form.php");
    exit();

  }else{
    
    //POSTされたデータを各変数に入れる
    $user_name = isset($_POST['user_name']) ? $_POST['user_name'] : NULL;
    $password = isset($_POST['password']) ? $_POST['password'] : NULL;
    
    //前後にある半角全角スペースを削除
    $user_name = spaceTrim($user_name);
    $password = spaceTrim($password);

    // アドレスが既に登録されているか判定
    $method = 'aes-256-cbc';
    $email = $_SESSION['email'];
    $encrypted_email = openssl_encrypt($email, $method, KEY);
    $sql = "SELECT * FROM users WHERE email = :encrypted_email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':encrypted_email', $encrypted_email);
    $stmt->execute();
    $user = $stmt->fetch();

    if($user){
      $errors['user'] = "既に登録されているアドレスです。";
    }
  
    require_once( "form_validation.php" );
    
  }
 
  //エラーが無ければセッションに登録
  if(count($errors) === 0){

    $_SESSION['user_name'] = $user_name;
    $_SESSION['password'] = $password;
    
  }

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