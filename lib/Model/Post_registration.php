<?php

  $user_id = $_SESSION['id'];
  $uniquid = uniqid(rand().'_');
  
  $sql = "INSERT INTO bbs_php.posts(title, content, uniquid, created_at, user_id) VALUES(:title, :content,  :uniquid, now(), :user_id)";

  $stmt = $pdo -> prepare($sql);

  $stmt->bindValue(':title', $title, PDO::PARAM_STR);
  $stmt->bindValue(':content', $content, PDO::PARAM_STR);
  $stmt->bindValue(':uniquid', $uniquid, PDO::PARAM_STR);
  $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
  $stmt->execute();
  
?>