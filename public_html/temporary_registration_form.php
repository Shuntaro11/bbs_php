<?php
  session_start();

  //クロスサイトリクエストフォージェリ（CSRF）対策
  $_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
  $token = $_SESSION['token'];

  include('./header.php');
?>
  <body>
    <h1>メール登録画面</h1>
    <form action="registration_check.php" method="post">
      <label>名前<label>
      <p><input type="text" name="user_name" size="20"></p>
      <label>パスワード<label>
      <p><input type="text" name="password" size="20"></p>
      <label>メールアドレス<label>
      <p><input type="text" name="email" size="50"></p>
      <input type="hidden" name="token" value="<?=$token?>">
      <input type="submit" value="登録する">
    </form>
  </body>
</html>