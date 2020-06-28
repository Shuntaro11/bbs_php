<?php
  session_start();

  //クロスサイトリクエストフォージェリ（CSRF）対策
  $_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
  $token = $_SESSION['token'];

  include('./header.php');
?>
  <body>
    <h1>会員登録</h1>
    <form action="pre_check.php" method="post" id="pre_form">
      <label>名前<label>
      <p><input type="text" name="user_name" id="pre_name" placeholder="全角20文字以内" size="20" onblur="judgeName()"></p>
      <p class="error-massage" id="pre_name_error"></p>
      <label>パスワード<label>
      <p><input type="password" name="password" id="pre_password" placeholder="半角英数字8~20文字" size="20" onblur="judgePassword()"></p>
      <p class="error-massage" id="pre_password_error"></p>
      <label>メールアドレス<label>
      <p><input type="text" name="email" id="pre_email" size="50" onblur="judgeEmail()"></p>
      <p class="error-massage" id="pre_email_error"></p>
      <input type="hidden" name="token" value="<?=$token?>">
      <input class="btn" type="submit" value="登録する">
    </form>
    <p><a class="btn" href="index.php">ホーム</a></p>
    <script type="text/javascript" src="../js/form_validation.js"></script>
  </body>
</html>