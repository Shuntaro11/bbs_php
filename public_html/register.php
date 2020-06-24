<?php
  require_once( "../config/dbconnect.php" );
  dbconnection();

  $user_name = $_POST['user_name'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $email = $_POST['email'];
  
  $method = 'aes-256-cbc';
  $encryptedemail = openssl_encrypt($email, $method, $password);

  $uniquid = uniqid(rand().'_');
  
  $sql = "INSERT INTO php_keiziban.users(user_name, email, password, uniquid, created_at) VALUES(:user_name, :email, :password, :uniquid, now())";

  $stmt = $pdo -> prepare($sql);

  $stmt->bindValue(':user_name', $user_name);
  $stmt->bindValue(':email', $encryptedemail);
  $stmt->bindValue(':password', $password);
  $stmt->bindValue(':uniquid', $uniquid);
  $stmt->execute();

  $msg = '会員登録が完了しました';

  $link = '<a href="login.php">ログインページ</a>';

?>

<h1><?php echo $msg; ?></h1><!--メッセージの出力-->
<?php echo $link; ?>