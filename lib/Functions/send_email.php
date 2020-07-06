<?php

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

?>