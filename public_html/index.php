<?php
  require_once( "../config/dbconnect.php" );
  dbconnection();

  session_start();

  define('POSTS_PER_PAGE', 5);
  
  if (preg_match('/^[1-9][0-9]*$/', $_GET['page'])) {
    $page = (int)$_GET['page'];
  } else {
      $page = 1;
  }

  // 今月の投稿数を取得
  $sql = "SELECT COUNT(id) FROM posts GROUP BY DATE_FORMAT(created_at, '%Y%m')";
  $howManyPosts = $pdo->query($sql)->fetchColumn();

  // 今月の登録者数を取得
  $sql = "SELECT COUNT(id) FROM users GROUP BY DATE_FORMAT(created_at, '%Y%m')";
  $howManyUsers = $pdo->query($sql)->fetchColumn();

  // このページの投稿を取得
  $offset = POSTS_PER_PAGE * ($page - 1);
  $sql = "SELECT posts.id AS post_id, posts.created_at AS created_at, user_name, title FROM posts INNER JOIN users ON posts.user_id = users.id ORDER BY post_id DESC limit " . $offset . "," . POSTS_PER_PAGE;
  $posts = $pdo->query($sql);

  // ページ数を取得
  $total = $pdo->query("select count(*) from posts")->fetchColumn();
  $totalPages = ceil($total / POSTS_PER_PAGE);

  // ○件目〜○件目を取得
  $from = $offset + 1;
  $to = ($offset + POSTS_PER_PAGE) < $total ? ($offset + POSTS_PER_PAGE) : $total;

  include('./header.php');
  
?>
  <body>
    <h1 class="main-title">SHUN BBS</h1>
    <div class="aggregate-table">
      <p>会員登録者数 <?PHP echo $howManyUsers ?> 人/月</p>
      <p>累計投稿数 <?PHP echo $howManyPosts ?> 件/月</p>
    </div>
    <?php
      if (isset($_SESSION['id'])) {//ログインしているとき
        echo '<div><a class="btn" href="logout.php">ログアウト</a></div>';
        echo '<div><a class="btn" href="post_form.php">投稿する</a></div>';

        echo '<div class="top-text">投稿一覧</div>';

        foreach ($posts as $post) {

          $date = new DateTime($post['created_at']);
          echo '<div class="each-post"><a href="post_show.php?id=' . $post['post_id'] .  '">' . $date->format('Y/n/d G:i ') . '<br> 投稿者：' . $post['user_name'] . '<br> title：' . $post['title'] . '</a></div>';

        }

        for($i = 1; $i <= $totalPages; $i++){
          echo '<a class="page-link" href="?page=' . $i .'">' . $i . '</a>';
        }

        echo '<p class="which-post">全' . $total . '件中、' . $from . '件~' . $to . '件</p>';

      } else {//ログインしていない時
        echo '<a class="btn" href="pre_registration_form.php">サインアップ</a>
        <br>
        <a class="btn" href="login_form.php">ログイン</a>';
      }
    ?>
  </body>
</html>