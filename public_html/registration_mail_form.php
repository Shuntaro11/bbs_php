<?php
  session_start();

  //クロスサイトリクエストフォージェリ（CSRF）対策
  $_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
  $token = $_SESSION['token'];

  include('./header.php');
?>
  <body>
    <h1>メール登録画面</h1>
    <form action="registration_mail_check.php" method="post">
      <p>メールアドレス：<input type="text" name="mail" size="50"></p>
      <input type="hidden" name="token" value="<?=$token?>">
      <input type="submit" value="登録する">
    </form>
  </body>
</html>