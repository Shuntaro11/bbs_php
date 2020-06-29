<?php

  //flagが0の未登録者・仮登録日から24時間以内
  $stmt = $pdo->prepare("SELECT * FROM pre_users WHERE urltoken=(:urltoken) AND flag =0 AND date > now() - interval 24 hour");
  $stmt->bindValue(':urltoken', $urltoken, PDO::PARAM_STR);
  $stmt->execute();

?>