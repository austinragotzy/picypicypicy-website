<?php //this is how we update the like/dislike for comments in database
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
 ?>
<?php //reply Likes
if(isset($_POST['relike'])){
  try {
    $sql = "UPDATE CommentReply SET Likes = Likes + 1 WHERE ReplyID = ?";
    $pdo->beginTransaction();
    $likeUpST = $pdo->prepare($sql);
    $likeUpST->bindValue(1, $_POST['relike']);
    $likeUpST->execute();
    $pdo->commit();
  } catch (PDOException $e) {
    $e->getMessage();
  }
}
if(isset($_POST['redislike'])){
  try {
    $sql = "UPDATE CommentReply SET Dislikes = Dislikes + 1 WHERE ReplyID = ?";
    $pdo->beginTransaction();
    $likeUpST = $pdo->prepare($sql);
    $likeUpST->bindValue(1, $_POST['redislike']);
    $likeUpST->execute();
    $pdo->commit();
  } catch (PDOException $e) {
    $e->getMessage();
  }
}
?>
<?php //this is how we add a comment to database
  if(isset($_POST['comment'])){
    try {
      $sql = "INSERT INTO Comments (UID, ImageID, Comment) VALUES (?, ?, ?)";
      $pdo->beginTransaction();
      $commentUpST = $pdo->prepare($sql);
      $commentUpST->bindValue(1, $_SESSION['UID']);
      $commentUpST->bindValue(2, $_GET['img']);
      $commentUpST->bindValue(3, $_POST['comment']);
      $commentUpST->execute();
      $pdo->commit();
    } catch (PDOException $e) {
      $e->getMessage();
    }

  }
?>
<?php  //this is where we add reply to database
if(isset($_POST['reply'])){
  try {
    $sql = "INSERT INTO CommentReply (UID, CommentID, Comment) VALUES (?, ?, ?)";
    $pdo->beginTransaction();
    $replyUpST = $pdo->prepare($sql);
    $replyUpST->bindValue(1, $_SESSION['UID']);
    $replyUpST->bindValue(2, $_POST['replybtn']);
    $replyUpST->bindValue(3, $_POST['reply']);
    $replyUpST->execute();
    $pdo->commit();
  } catch (PDOException $e) {
    $e->getMessage();
  }

}
?>
<?php //populate the comments
include 'connect.php';
try {
  $sql = "SELECT * FROM Comments WHERE ImageID = ? ORDER BY Date DESC";
  $commentST = $pdo->prepare($sql);
  $commentST->bindValue(1, $_GET['img']);
  $commentST->execute();

} catch (PDOException $e) {
  die($e->getMessage());
}
while($commentTup = $commentST->fetch()){
  try {
    $sql = "SELECT count(ReplyID) as replies FROM CommentReply WHERE CommentID = ?";
    $numReplyST = $pdo->prepare($sql);
    $numReplyST->bindValue(1, $commentTup['CommentID']);
    $numReplyST->execute();

    $sql = "SELECT * FROM CommentReply WHERE CommentID = ? ORDER BY Likes - Dislikes DESC";
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
        <p><span class="commenter">'.$commenterTup['Username'].': </span>'.$commentTup['Comment'].'</p>
        <p class="pull-right">Posted: '.date('F d, Y', strtotime($commentTup['Date'])).'</p><br>
      </div>
      <div class="row cr">
        <form class="" action="image.php?img='.$_GET['img'].'" method="post">
          <button type="submit" name="like" value="'.$commentTup['CommentID'].'">'.$commentTup['Likes'].' <span class="glyphicon glyphicon-thumbs-up"></span></button>
          <button type="submit" name="dislike" value="'.$commentTup['CommentID'].'">'.$commentTup['Dislikes'].' <span class="glyphicon glyphicon-thumbs-down"></span></button>
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
      echo '<div class="">
      <div class="replier-row">
      <div class="row">
        <p class="replycom"><span class="replier">'.$replierTup['Username'].':</span> '.$replyTup['Comment'].'</p>
      </div>
      <div class="row vote">
        <form class="" action="image.php?img='.$_GET['img'].'" method="post">
          <button type="submit" name="relike" value="'.$replyTup['ReplyID'].'">'.$replyTup['Likes'].' <span class="glyphicon glyphicon-thumbs-up"></span></button>
          <button type="submit" name="redislike" value="'.$replyTup['ReplyID'].'">'.$replyTup['Dislikes'].' <span class="glyphicon glyphicon-thumbs-down"></span></button>
        </form>
      </div>
        </div>';
    }
    echo '<br><form class="input-group reply" action="image.php?img='.$_GET['img'].'" method="post">
      <div class="form-group">
        <input type="text" class="form-control" name="reply" placeholder="what do YOU want to say to '.$commenterTup['Username'].'"></input>
      </div>
        <div class="input-group-btn" style="height=100%;">
          <button class="btn btn-default" type="submit" name="replybtn" value="'.$commentTup['CommentID'].'"><span class="glyphicon glyphicon-pencil"></span>Submit<span class="glyphicon glyphicon-pencil"></span></button>
        </div>
    </form>
  </details><br>';
}
echo '<form class="input-group" style="width: 100%;" action="image.php?img='.$_GET['img'].'" method="post">
  <div class="form-group">
    <input type="text" class="form-control" name="comment" placeholder="how do YOU really feel"></input>
  </div>
    <div class="input-group-btn" style="height=100%;">
      <button class="btn btn-default" type="submit" name=""><span class="glyphicon glyphicon-pencil"></span>Submit<span class="glyphicon glyphicon-pencil"></span></button>
    </div>
</form>';
 ?>
