<?php

session_start();
if (!isset($_SESSION['id'])) {
  header('Location: /bbs_php/public_html/login_form.php');
  exit;
}

//クロスサイトリクエストフォージェリ（CSRF）対策
$_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
$token = $_SESSION['token'];

include('./header.php');

?>
  <body>
    <div class="container">
      <h1>投稿</h1>
      <form action="post.php" method="POST">
      <div>
          <label for="title">タイトル</label>
          <p><input type="text" id="title" name="title" placeholder="タイトルを30文字以内で入力してください"></p>
      </div>
      <div>
          <label for="content">本文</label>
          <p><textarea cols="50" rows="10" id="content" name="content" placeholder="本文を入力してください"></textarea></p>
      </div>
          <input type="hidden" name="token" value="<?=$token?>">
          <input class="btn submit-btn" type="submit" class="btn" value="投稿">
      </form>
      <a class="btn" href="index.php">ホーム</a>
    </div>
  </body>
</html>