<?php
  include('env.php');
  function dbconnection() {
    global $pdo, $e;
    try {
      // データベースに接続
      $pdo = new PDO(
        'mysql:dbname=' . DB_DBNAME . ';host=' . DB_HOSTNAME . ';charset=utf8mb4',
        DB_USERNAME,
        DB_PASSWORD,
        //例外処理を投げる（スロー）ようにする
        [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
      );
    } catch (PDOException $e) {
      //エラー発生時
      echo $e->getMessage();
      exit;
    }
  }
?>