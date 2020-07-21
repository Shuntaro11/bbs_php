<?php
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

?>
<?php
include('./header.php');
?>
  <body>
      <div class="top-text">記事詳細</div>
      <div class="post-title">
          <?php echo 'タイトル：' . $post[0]['title']; ?>
      </div>
      <div>
          <?php echo '投稿者：' . $user[0]['user_name']; ?>
      </div>
      <div class="post-content">
          <?php echo $post[0]['content']; ?>
      </div>

      <div class="container">
        <form action="comment.php" method="POST">
          
            <p><label for="comment">コメント</label></p>
            <div><textarea cols="70" rows="3" id="comment" name="comment" placeholder="本文を入力してください"></textarea></div>
            <div><button type="submit">コメントする</button></div>
          
        </form>
      </div>
      <p><a href="index.php" class="btn">ホーム</a></p>
  </body>
</html>