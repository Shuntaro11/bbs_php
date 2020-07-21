<?php
  
  session_start();
  //クロスサイトリクエストフォージェリ（CSRF）対策のトークン判定
  if ($_POST['token'] != $_SESSION['token']){
    echo "不正アクセスの可能性あり";
    exit();
  }

  if(empty($_POST)) {

    header("Location: /bbs_php/public_html/post_form.php");
    exit();

  }else{
    
    $errors = array();

    //POSTされたデータを変数に入れる
    $title = isset($_POST['title']) ? $_POST['title'] : NULL;
    $content = isset($_POST['content']) ? $_POST['content'] : NULL;

    require_once( "../lib/Functions/post_form_validation.php" );

    if (count($errors) === 0){
	
      //データベース接続
      require_once( "../config/dbconnect.php" );
      dbconnection();
            
      //ここでpostsテーブルに登録する
      try{
        
        require_once( "../lib/Model/Post_registration.php" );

        $msg = '投稿しました';
  
      }catch (PDOException $e){

        print('Error:'.$e->getMessage());
        die();

      }
      
    }
  }

  include('./header.php');

?>

    <body>
        <?php if (count($errors) === 0): ?>
            <p><?php echo $msg; ?></p>
        <?php elseif(count($errors) > 0): ?>
            <h1>認証メールを送信できません</h1>
            <?php
            foreach($errors as $value){
              echo "<p class='error-massage'>" . $value . "</p>";
            }
            ?>
            <input class="btn" type="button" value="戻る" onClick="history.back()">
        <?php endif; ?>
        <p><a class="btn" href="index.php">ホーム</a></p>
    </body>
</html>