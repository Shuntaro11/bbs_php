<?php

  //トランザクション開始
  $pdo->beginTransaction();
    
  //usersテーブルに本登録する
  $stmt = $pdo->prepare("INSERT INTO users (uniquid, user_name, email, password, created_at) VALUES (:uniquid, :user_name, :encrypted_email, :password_hash, now())");
  
  $stmt->bindValue(':uniquid', $uniquid, PDO::PARAM_STR);
  $stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
  $stmt->bindValue(':encrypted_email', $encrypted_email, PDO::PARAM_STR);
  $stmt->bindValue(':password_hash', $password_hash, PDO::PARAM_STR);
  $stmt->execute();
    
  //pre_usersのflagを1にする
  $stmt = $pdo->prepare("UPDATE pre_users SET flag=1 WHERE email=(:encrypted_email)");

  //プレースホルダへ実際の値を設定する
  $stmt->bindValue(':encrypted_email', $encrypted_email, PDO::PARAM_STR);
  $stmt->execute();
  
  // トランザクション完了（コミット）
  $pdo->commit();
    
  //データベース接続切断
  $pdo = null;

?>