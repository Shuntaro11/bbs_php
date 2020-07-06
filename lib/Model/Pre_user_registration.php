<?php

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
  $pdo = null;

?>