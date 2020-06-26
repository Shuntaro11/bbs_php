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
 
  //エラーメッセージの初期化
  $errors = array();
 
  if(empty($_POST)) {

    header("Location: temporary_registration_form.php");// リダイレクト
    exit();

  }else{
    //POSTされたデータを変数に入れる
    $email = isset($_POST['email']) ? $_POST['email'] : NULL;
    $user_name = isset($_POST['user_name']) ? $_POST['user_name'] : NULL;
    $password = isset($_POST['password']) ? $_POST['password'] : NULL;

    // アドレスを暗号化
    $method = 'aes-256-cbc';
    $encryptedemail = openssl_encrypt($email, $method, KEY);
    
    // アドレスが既に登録されているか判定
    $sql = "SELECT * FROM users WHERE email = :encryptedemail";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':encryptedemail', $encryptedemail);
    $stmt->execute();
    $user = $stmt->fetch();
    if($user){
      $errors['user'] = "既に登録されているアドレスです。";
    }

    require_once( "form_validation.php" );

  }
?>

<?php
foreach($errors as $value){
	echo "<p>".$value."</p>";
}
?>