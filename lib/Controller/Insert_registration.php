<?php

  //クロスサイトリクエストフォージェリ（CSRF）対策のトークン判定
  if ($_POST['token'] != $_SESSION['token']){
    echo "不正アクセスの可能性あり";
    exit();
  }
 
  //エラーメッセージの初期化
  $errors = array();
 
  if(empty($_POST)) {
    header("Location: pre_registration_form.php");
    exit();
  }
 
  $email = $_SESSION['email'];
  $user_name = $_SESSION['user_name'];
 
  //パスワードのハッシュ化
  $password_hash =  password_hash($_SESSION['password'], PASSWORD_DEFAULT);

  // ユニークidを作成
  $uniquid = uniqid(rand().'_');

  // アドレスを暗号化
  $method = 'aes-256-cbc';
  $encrypted_email = openssl_encrypt($email, $method, KEY);

  //ここでデータベースに登録する
  try{

    require_once( "../lib/Model/User_registration.php" );
    
    //セッション変数を全て解除
    $_SESSION = array();
    
    //セッションクッキーの削除
    if (isset($_COOKIE["PHPSESSID"])) {
          setcookie("PHPSESSID", '', time() - 1800, '/');
    }
    
    //セッションを破棄する
    session_destroy();
    
  }catch (PDOException $e){

    //トランザクション取り消し（ロールバック）
    $pdo->rollBack();
    $errors['error'] = "もう一度やりなおして下さい。";
    print('Error:'.$e->getMessage());

  }

?>