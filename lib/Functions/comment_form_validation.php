<?php
  
  // バリデーション

  if(strlen($comment) === 0){
    $errors['comment'] = "コメントが入力されていません。";
  }
  
?>