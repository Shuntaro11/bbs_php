<?php

  session_start();

  try {

    require_once( "../config/dbconnect.php" );
    dbconnection();

    $comment_id = $_REQUEST['id'];

    // echo "a";

    $stmt = $pdo->prepare("SELECT * FROM comments WHERE id = $comment_id");
    $stmt->execute();
    $comment = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $post_id = $comment[0]['post_id'];

    if($comment[0]['user_id'] === $_SESSION['id']){
      
      $stmt = $pdo->prepare("DELETE FROM comments WHERE id = $comment_id");
      $stmt->execute();

    }

    header('Location: /bbs_php/public_html/post_show.php?id=' . $post_id);
    exit();


  } catch (Exception $e) {

    echo 'エラーが発生しました。:' . $e->getMessage();

    header("location:javascript://history.go(-1)");
    exit();
    
  }

?>