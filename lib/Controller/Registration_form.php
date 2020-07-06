<?php

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
        require_once( "../lib/Model/Get_pre_user.php" );
        
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
?>