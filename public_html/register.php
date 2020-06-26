<?php
  require_once( "../config/dbconnect.php" );
  dbconnection();

  $uniquid = uniqid(rand().'_');
  $user_name = $_POST['user_name'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $email = $_POST['email'];
  
  $method = 'aes-256-cbc';
  $encryptedemail = openssl_encrypt($email, $method, KEY);
  
  $sql = "INSERT INTO bbs_php.users(uniquid, user_name, email, password, created_at) VALUES(:uniquid, :user_name, :email, :password, now())";

  $stmt = $pdo -> prepare($sql);

  $stmt->bindValue(':uniquid', $uniquid);
  $stmt->bindValue(':user_name', $user_name);
  $stmt->bindValue(':email', $encryptedemail);
  $stmt->bindValue(':password', $password);
  $stmt->execute();

  $msg = '会員登録が完了しました';

  $link = '<a href="index.php">ホーム</a>';

?>

<p><?php echo $msg; ?></p><!--メッセージの出力-->
<p><?php echo $link; ?></p>