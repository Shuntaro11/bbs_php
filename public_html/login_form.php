<?php
include('./header.php');
?>
  <body>
    <h1>ログインページ</h1>
    <form action="login.php" method="post">
    <div>
      <label>名前<label>
      <p><input type="text" name="user_name" required></p>
    </div>
    <div>
        <label>パスワード<label>
        <p><input type="password" name="password" required></p>
    </div>
    <input class="btn submit-btn" type="submit" value="ログイン">
    </form>
    <a class="btn" href="index.php">ホーム</a>
  </body>
</html>