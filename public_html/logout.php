<?php
session_start();
$_SESSION = array();//セッションの中身をすべて削除
session_destroy();//セッションを破壊

include('./header.php');
?>

<p>ログアウトしました。</p>
<a class="btn" href="login_form.php">ログイン</a>
<br>
<a class="btn" href="index.php">ホーム</a>