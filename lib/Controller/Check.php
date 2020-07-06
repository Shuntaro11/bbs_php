<?php

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
    require_once( "../lib/Model/Judge_email.php" );
  
    require_once( "../lib/Functions/form_validation.php" );
  }
 
  //エラーが無ければセッションに登録
  if(count($errors) === 0){

    $_SESSION['user_name'] = $user_name;
    $_SESSION['password'] = $password;
    
  }

?>