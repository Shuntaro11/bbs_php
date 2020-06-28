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

    header("Location: pre_registration_form.php");// リダイレクト
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
    
    // アドレスが既に登録されているか判定
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

  if (count($errors) === 0){
	
    $urltoken = hash('sha256',uniqid(rand(),1));
    $url = "http://localhost/bbs_php/public_html/registration_form.php"."?urltoken=".$urltoken;
    
    //ここでデータベースに登録する
    try{
      // ユニークidを作成
      $uniquid = uniqid(rand().'_');

      $sql = "INSERT INTO pre_users(uniquid, urltoken, user_name, email, password, date) VALUES(:uniquid, :urltoken, :user_name, :encrypted_email, :encrypted_password, now())";

      $stmt = $pdo -> prepare($sql);

      $stmt->bindValue(':uniquid', $uniquid, PDO::PARAM_STR);
      $stmt->bindValue(':urltoken', $urltoken, PDO::PARAM_STR);
      $stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
      $stmt->bindValue(':encrypted_email', $encrypted_email, PDO::PARAM_STR);
      $stmt->bindValue(':encrypted_password', $encrypted_password, PDO::PARAM_STR);
      $stmt->execute();
        
      //データベース接続切断
      $dbh = null;	
      
    }catch (PDOException $e){
      print('Error:'.$e->getMessage());
      die();
    }
    //メールの宛先
    $to = $email;
   
    //Return-Pathに指定するメールアドレス
    $returnMail = 'web@sample.com';
   
    $name = "SHUN BBS";
    $mail = 'web@sample.com';
    $subject = "【SHUN BBS】会員登録用URLのお知らせ";
   
    $body = <<< EOM
    24時間以内に下記のURLからご登録下さい。
    {$url}
    EOM;

    mb_language("Japanese");
    mb_internal_encoding("UTF-8");
  
    //Fromヘッダーを作成
    $header = 'From: ' . mb_encode_mimeheader($name). ' <' . $mail. '>';
  
    if (mb_send_mail($to, $subject, $body, $header, '-f'. $returnMail)) {
    
      //セッション変数を全て解除
      $_SESSION = array();
    
      //クッキーの削除
      if (isset($_COOKIE["PHPSESSID"])) {
        setcookie("PHPSESSID", '', time() - 1800, '/');
      }
    
      //セッションを破棄する
      session_destroy();
    
      $message = "メールをお送りしました。24時間以内にメールに記載されたURLからご登録下さい。";
    
    } else {
      $errors['mail_error'] = "メールの送信に失敗しました。";
    }	
  }

  include('./header.php');

?>

  <body>
    <h1>メール確認画面</h1>
    <?php if (count($errors) === 0): ?>
      <p><?=$message?></p>
    <?php elseif(count($errors) > 0): ?>
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