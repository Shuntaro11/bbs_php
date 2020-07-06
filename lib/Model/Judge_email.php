<?php

  // アドレスが既に登録されているか判定
  $sql = "SELECT * FROM users WHERE email = :encrypted_email";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':encrypted_email', $encrypted_email);
  $stmt->execute();
  $user = $stmt->fetch();

  if($user){
    $errors['user'] = "既に登録されているアドレスです。";
  }

?>