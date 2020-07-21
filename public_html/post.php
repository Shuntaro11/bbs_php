<?php
  
  session_start();
  //クロスサイトリクエストフォージェリ（CSRF）対策のトークン判定
  if ($_POST['token'] != $_SESSION['token']){
    echo "不正アクセスの可能性あり";
    exit();
  }

  require_once( "../config/dbconnect.php" );
  dbconnection();
  
  session_start();
  $user_id = $_SESSION['id'];
  $user_name = $_SESSION['user_name'];
  $uniquid = uniqid(rand().'_');

  $title = $_POST['title'];
  $content = $_POST['content'];
  
  $sql = "INSERT INTO bbs_php.posts(title, content, uniquid, created_at, user_id) VALUES(:title, :content,  :uniquid, now(), :user_id)";

  $stmt = $pdo -> prepare($sql);

  $stmt->bindValue(':title', $title, PDO::PARAM_STR);
  $stmt->bindValue(':content', $content, PDO::PARAM_STR);
  $stmt->bindValue(':uniquid', $uniquid, PDO::PARAM_STR);
  $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
  $stmt->execute();

  $msg = '投稿しました';

?>

<p><?php echo $msg; ?></p>
<a href="index.php">ホーム</a>