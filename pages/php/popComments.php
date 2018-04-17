<?php
if(isset($_POST['like'])){
  try {
    $sql = "UPDATE Comments SET Likes = Likes + 1 WHERE CommentID = ?";
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
    $sql = "UPDATE Comments SET Dislikes = Dislikes + 1 WHERE CommentID = ?";
    $pdo->beginTransaction();
    $likeUpST = $pdo->prepare($sql);
    $likeUpST->bindValue(1, $_POST['dislike']);
    $likeUpST->execute();
    $pdo->commit();
  } catch (PDOException $e) {
    $e->getMessage();
  }

}
//i will clean this up later hopefully
include 'connect.php';
try {
  $sql = "SELECT * FROM Comments WHERE ImageID = ?";
  $commentST = $pdo->prepare($sql);
  $commentST->bindValue(1, $_GET['img']);
  $commentST->execute();

} catch (PDOException $e) {
  die($e->getMessage());
}
//here is the break
while($commentTup = $commentST->fetch()){
  try {
    $sql = "SELECT count(ReplyID) as replies FROM CommentReply WHERE CommentID = ?";
    $numReplyST = $pdo->prepare($sql);
    $numReplyST->bindValue(1, $commentTup['CommentID']);
    $numReplyST->execute();

    $sql = "SELECT * FROM CommentReply WHERE CommentID = ?";
    $replyST = $pdo->prepare($sql);
    $replyST->bindValue(1, $commentTup['CommentID']);
    $replyST->execute();

    $sql = "SELECT * FROM User WHERE UID = ?";
    $commenterST = $pdo->prepare($sql);
    $commenterST->bindValue(1, $commentTup['UID']);
    $commenterST->execute();
  } catch (PDOException $e) {
    $e->getMessage();
  }
  $numRep = $numReplyST->fetch();
  $commenterTup = $commenterST->fetch();
  echo '<details>
    <summary class="commenter-row">
      <div class="row cr">
        <p><span class="commenter">'.$commenterTup['Username'].': </span>'.$commentTup['Comment'].'</p><br>
      </div>
      <div class="row cr">
        <form class="" action="image.php?img='.$_GET['img'].'" method="post">
          <p>'.$commentTup['Likes'].'</p>
          <button type="submit" name="like" value="'.$commentTup['CommentID'].'"><span class="glyphicon glyphicon-thumbs-up"></span></button>
          <p>'.$commentTup['Dislikes'].'</p>
          <button type="submit" name="dislike" value="'.$commentTup['CommentID'].'"><span class="glyphicon glyphicon-thumbs-down"></span></button>
          <p class="pull-right">'.$numRep['replies'].' replies</p>
        </form>
      </div>
    </summary>';
    while($replyTup = $replyST->fetch()){
      try {
        $sql = "SELECT * FROM User WHERE UID = ?";
        $replierST = $pdo->prepare($sql);
        $replierST->bindValue(1, $replyTup['UID']);
        $replierST->execute();
      } catch (PDOException $e) {
        $e->getMessage();
      }
      $replierTup = $replierST->fetch();
      echo '<div class="container-fluid">
        <div class="row replier-row">
          <p class="reply"><span class="replier">'.$replierTup['Username'].':</span> '.$replyTup['Comment'].'</p>
        </div>
      </div><br>';
    }
    echo '<form class="input-group reply" action="index.html" method="post">
      <div class="form-group">
        <input type="text" class="form-control" name="reply" rows="2" placeholder="what do YOU want to say to '.$commenterTup['Username'].'"></input>
      </div>
        <div class="input-group-btn" style="height=100%;">
          <button class="btn btn-default" type="submit" name=""><span class="glyphicon glyphicon-pencil"></span>Submit<span class="glyphicon glyphicon-pencil"></span></button>
        </div>
    </form>
  </details><br>';
}
 ?>
