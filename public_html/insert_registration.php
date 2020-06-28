<?php

  //データベース接続
  require_once( "../config/dbconnect.php" );
  dbconnection();

  session_start();
 
  //クロスサイトリクエストフォージェリ（CSRF）対策のトークン判定
  if ($_POST['token'] != $_SESSION['token']){
    echo "不正アクセスの可能性あり";
    exit();
  }
 
  //エラーメッセージの初期化
  $errors = array();
 
  if(empty($_POST)) {
    header("Location: pre_registration_form.php");
    exit();
  }
 
  $email = $_SESSION['email'];
  $user_name = $_SESSION['user_name'];
 
  //パスワードのハッシュ化
  $password_hash =  password_hash($_SESSION['password'], PASSWORD_DEFAULT);

  // ユニークidを作成
  $uniquid = uniqid(rand().'_');

  // アドレスを暗号化
  $method = 'aes-256-cbc';
  $encrypted_email = openssl_encrypt($email, $method, KEY);
 
  //ここでデータベースに登録する
  try{

    //トランザクション開始
    $pdo->beginTransaction();
    
    //usersテーブルに本登録する
    $stmt = $pdo->prepare("INSERT INTO users (uniquid, user_name, email, password, created_at) VALUES (:uniquid, :user_name, :encrypted_email, :password_hash, now())");
    
    $stmt->bindValue(':uniquid', $uniquid, PDO::PARAM_STR);
    $stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
    $stmt->bindValue(':encrypted_email', $encrypted_email, PDO::PARAM_STR);
    $stmt->bindValue(':password_hash', $password_hash, PDO::PARAM_STR);
    $stmt->execute();
      
    //pre_usersのflagを1にする
    $stmt = $pdo->prepare("UPDATE pre_users SET flag=1 WHERE email=(:encrypted_email)");

    //プレースホルダへ実際の値を設定する
    $stmt->bindValue(':encrypted_email', $encrypted_email, PDO::PARAM_STR);
    $stmt->execute();
    
    // トランザクション完了（コミット）
    $pdo->commit();
      
    //データベース接続切断
    $pdo = null;
    
    //セッション変数を全て解除
    $_SESSION = array();
    
    //セッションクッキーの削除
    if (isset($_COOKIE["PHPSESSID"])) {
          setcookie("PHPSESSID", '', time() - 1800, '/');
    }
    
    //セッションを破棄する
    session_destroy();
    
    /*
    登録完了のメールを送信
    */
    
  }catch (PDOException $e){

    //トランザクション取り消し（ロールバック）
    $pdo->rollBack();
    $errors['error'] = "もう一度やりなおして下さい。";
    print('Error:'.$e->getMessage());

  }

  include('./header.php');

?>

  <body>
  
    <?php if (count($errors) === 0): ?>

      <h1>会員登録完了</h1>
      
      <p>登録完了いたしました。</p>
      <p><a href=""></a></p>
      
    <?php elseif(count($errors) > 0): ?>
      
      <?php
      foreach($errors as $value){
        echo "<p class='error-massage'>".$value."</p>";
      }
      ?>
    
    <?php endif; ?>
  
  </body>
</html>