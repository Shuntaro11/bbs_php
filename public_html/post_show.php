<?php

  session_start();
  if (!isset($_SESSION['id'])) {
    header('Location: /bbs_php/public_html/login_form.php');
    exit;
  }

  //クロスサイトリクエストフォージェリ（CSRF）対策
  $_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
  $token = $_SESSION['token'];

  require_once( "../config/dbconnect.php" );
  dbconnection();

  $post_id = $_REQUEST['id'];
  $sql = "SELECT * FROM posts WHERE id = $post_id";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $post = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $user_id = $post[0]['user_id'];
  $sql = "SELECT * FROM users WHERE id = $user_id";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $sql = "SELECT comments.id AS comment_id, comment, comments.user_id AS user_id, comments.created_at AS created_at, users.user_name AS user_name
  FROM comments INNER JOIN users ON comments.user_id = users.id WHERE post_id = $post_id ORDER BY comment_id DESC";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
?>
<?php
include('./header.php');
?>
  <body>
      <div class="top-text">記事詳細</div>
      <div class="post-container">
          <div class="post-title">
              <?php echo 'タイトル：' . $post[0]['title']; ?>
          </div>
          <div>
              <?php echo '投稿者：' . $user[0]['user_name']; ?>
          </div>
          <div class="post-content">
              <?php echo '本文：<br>' . nl2br($post[0]['content']); ?>
          </div>
          <div>
              <?php echo '投稿日時：' . $post[0]['created_at']; ?>
          </div>
      </div>
      

      <div class="comment-container">
        <form action="comment.php" method="POST">
            <p><label for="comment">コメントする</label></p>
            <!-- <p class="error-massage"></p> -->
            <div><textarea cols="70" rows="3" id="comment" name="comment" placeholder="本文を入力してください"></textarea></div>
            <input type="hidden" name="post_id" value="<?=$post[0]['id']?>">
            <input type="hidden" name="token" value="<?=$token?>">
            <div class="comment-btn"><button type="submit">送信</button></div>
          
        </form>
        <div class="comment-list">
            <h3>コメント一覧</h3>
            <?php
                foreach ($comments as $comment) {
                    $date = new DateTime($comment['created_at']);
                    echo '<div class="each-comment"><p class="comment-info">' . $date->format('Y/n/d G:i ') . $comment['user_name'] . '</p>' . $comment['comment'] . '</div>';
                }
            ?>
        </div>
        
      </div>
      <p><a href="index.php" class="btn">ホーム</a></p>
  </body>
</html>