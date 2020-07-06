<?php
require_once( "../config/dbconnect.php" );
dbconnection();

session_start();
$user_name = $_POST['user_name'];

$sql = "SELECT * FROM users WHERE user_name = :user_name";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_name', $user_name);
$stmt->execute();
$member = $stmt->fetch();

include('./header.php');

if(password_verify($_POST['password'], $member['password'])){
  $_SESSION['id'] = $member['id'];
  $_SESSION['user_name'] = $member['user_name'];
  $msg = "ログインしました。";
  $link = '<a class="btn" href="index.php">ホーム</a>';
} else {
  $msg = 'メールアドレスもしくはパスワードが間違っています。';
  $link = '<a class="btn" href="login_form.php">戻る</a>';
}

?>

<h1><?php echo $msg; ?></h1>
<?php echo $link; ?>