<?php
  
  session_start();

  //クロスサイトリクエストフォージェリ（CSRF）対策のトークン判定
  if ($_POST['token'] != $_SESSION['token']){
    echo "不正アクセスの可能性あり";
    exit();
  }

  if(empty($_POST)) {

    header("Location: /bbs_php/public_html");
    exit();

  }else{
    
    $errors = array();

    //POSTされたデータを変数に入れる
    $comment = isset($_POST['comment']) ? $_POST['comment'] : NULL;
    $post_id = isset($_POST['post_id']) ? $_POST['post_id'] : NULL;

    require_once( "../lib/Functions/comment_form_validation.php" );

    if (count($errors) === 0){
	
      //データベース接続
      require_once( "../config/dbconnect.php" );
      dbconnection();
            
      //ここでcommentsテーブルに登録する
      try{
        
        require_once( "../lib/Model/Comment_registration.php" );
  
      }catch (PDOException $e){

        // print('Error:'.$e->getMessage());
        die();

      }
      
    }

    header('Location: /bbs_php/public_html/post_show.php?id=' . $post_id);
    exit();

  }

?>