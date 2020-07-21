<?php

  $user_id = $_SESSION['id'];
  $uniquid = uniqid(rand().'_');
  
  $sql = "INSERT INTO bbs_php.comments(comment, uniquid, created_at, user_id, post_id) VALUES(:comment,  :uniquid, now(), :user_id, :post_id)";

  $stmt = $pdo -> prepare($sql);

  $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
  $stmt->bindValue(':uniquid', $uniquid, PDO::PARAM_STR);
  $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
  $stmt->bindValue(':post_id', $post_id, PDO::PARAM_INT);
  $stmt->execute();

  
?>