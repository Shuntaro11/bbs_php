<?php

  // バリデーション
  if(strlen($email) === 0){
    $errors['email'] = "アドレスが入力されていません。";
  }elseif(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email)){
      $errors['email_check'] = "メールアドレスの形式が正しくありません。";
  }

  if(strlen($user_name) === 0){
    $errors['user_name'] = "名前が入力されていません。";
  }else if(strlen($user_name) > 20 || !preg_match("/^[ぁ-んァ-ン一-龥]+$/", $user_name)){
    $errors['user_name'] = "名前は全角１〜２０文字で入力してください。"; 
  }

  if(strlen($password) === 0){
    $errors['password'] = "パスワードが入力されていません。";
  }else if(strlen($password) > 20 || strlen($password) < 8 || !preg_match("/^[a-zA-Z0-9]+$/", $password)){
    $errors['password'] = "パスワードは半角英数字８〜２０文字で入力してください。"; 
    
  }
?>