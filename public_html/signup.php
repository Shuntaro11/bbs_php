<?php
include('./header.php');
?>
  <body>
    <h1>新規会員登録</h1>
    <form action="register.php" method="post">
    <div>
        <label>名前：<label>
        <input type="text" name="user_name" required>
    </div>
    <div>
        <label>メールアドレス：<label>
        <input type="text" name="email" required>
    </div>
    <div>
        <label>パスワード：<label>
        <input type="password" name="password" required>
    </div>
    <input type="submit" value="新規登録">
    </form>
    <p><a href="index.php">ホーム</a></p>
  </body>
</html>