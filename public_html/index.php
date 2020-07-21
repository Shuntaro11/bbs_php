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

        $sql = "SELECT * FROM posts JOIN users ON posts.user_id =  users.id";
        $posts = $pdo->query($sql);

        echo '<div class="top-text">投稿一覧</div>';

        foreach ($posts as $post) {
          $date = new DateTime($post['created_at']);

          echo '<div class="each-post"><a href="post_show.php?id=' . $post['id'] .  '">' . $date->format('Y/n/d G:i ') . '<br> 投稿者：' . $post['user_name'] . '<br> title：' . $post['title'] . '</a></div>';
        }

      } else {//ログインしていない時
        echo '<a class="btn" href="pre_registration_form.php">サインアップ</a>
        <br>
        <a class="btn" href="login_form.php">ログイン</a>';
      }
    ?>
  </body>
</html>