<?php
  
  // バリデーション

  if(strlen($title) === 0){
    $errors['title'] = "タイトルが入力されていません。";
  }else if(strlen($title) > 30){
    $errors['title'] = "タイトルは１〜３０文字で入力してください。"; 
  }

  if(strlen($content) === 0){
    $errors['content'] = "本文が入力されていません。";
  }
  
?>