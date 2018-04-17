<?php
  if(isset($_POST['like'])){
    try {
      $sql = "UPDATE ? SET Likes = Likes + 1";
      $pdo->beginTransaction();
      $likeUpST = $pdo->prepare($sql);
      $likeUpST->bindValue(1, $_POST['like']);
      $likeUpST->execute();
      $pdo->commit();
    } catch (PDOException $e) {
      $e->getMessage();
    }

  }
  if(isset($_POST['dislike'])){
    try {

    } catch (PDOException $e) {
      $e->getMessage();
    }

  }
?>
