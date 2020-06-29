<?php
      
  //クロスサイトリクエストフォージェリ（CSRF）対策のトークン判定
  if ($_POST['token'] != $_SESSION['token']){
    echo "不正アクセスの可能性あり??";
    exit();
  }

  //エラーメッセージの初期化
  $errors = array();

  if(empty($_POST)) {

    // リダイレクト
    header("Location: pre_registration_form.php");
    exit();

  }else{

    //POSTされたデータを変数に入れる
    $email = isset($_POST['email']) ? $_POST['email'] : NULL;
    $user_name = isset($_POST['user_name']) ? $_POST['user_name'] : NULL;
    $password = isset($_POST['password']) ? $_POST['password'] : NULL;

    // アドレスを暗号化
    $method = 'aes-256-cbc';
    $encrypted_email = openssl_encrypt($email, $method, KEY);

    // パスワードを暗号化
    $encrypted_password = openssl_encrypt($password, $method, KEY);
    
    require_once( "../lib/Model/Judge_email.php" );

    require_once( "../lib/Functions/form_validation.php" );

  }

?>