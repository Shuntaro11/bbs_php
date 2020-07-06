<?php
  include('./header.php');
  session_start();
?>
  <body>
    <h1 class="main-title">SHUN BBS</h1>
    <?php
      if (isset($_SESSION['id'])) {//ログインしているとき
        echo '<a class="btn" href="logout.php">ログアウト</a>';
      } else {//ログインしていない時
        echo '<a class="btn" href="pre_registration_form.php">サインアップ</a>
        <br>
        <a class="btn" href="login_form.php">ログイン</a>';
      }
    ?>
  </body>
</html>