<?php
require_once( "../config/dbconnect.php" );
dbconnection();

session_start();
$username = $_POST['username'];

$sql = "SELECT * FROM users WHERE username = :username";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username);
$stmt->execute();
$member = $stmt->fetch();

if(password_verify($_POST['password'], $member['password'])){
  $_SESSION['id'] = $member['id'];
  $_SESSION['username'] = $member['username'];
  $msg = "ログインしました。";
  $link = '<a class="btn" href="index.php">ホーム</a>';
} else {
  $msg = 'メールアドレスもしくはパスワードが間違っています。';
  $link = '<a class="btn" href="login_form.php">戻る</a>';
}

?>

<h1><?php echo $msg; ?></h1>
<?php echo $link; ?>