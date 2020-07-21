<?php
  require_once( "../config/dbconnect.php" );
  dbconnection();

  session_start();

  include('./header.php');
  
?>
  <body>
    <h1 class="main-title">SHUN BBS</h1>
    <?php
      if (isset($_SESSION['id'])) {//ログインしているとき
        echo '<div><a class="btn" href="logout.php">ログアウト</a></div>';
        echo '<div><a class="btn" href="post_form.php">投稿する</a></div>';

        $sql = "SELECT * FROM posts";
        $posts = $pdo->query($sql);

        foreach ($posts as $post) {
          $date = new DateTime($post['created_at']);
          echo '<a href="post_show.php?id=' . $post['id'] .  '">' . $date->format('Y/n/d G:i ');
          echo ' 投稿者：' . $post['user_name'];
          echo '<br> title：' . $post['title'] . '</a>';
          echo '<br>';
        }
      } else {//ログインしていない時
        echo '<a class="btn" href="pre_registration_form.php">サインアップ</a>
        <br>
        <a class="btn" href="login_form.php">ログイン</a>';
      }
    ?>
  </body>
</html>