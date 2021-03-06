<?php //this is how we update the like/dislike for comments in database
if(isset($_POST['delete']))
{

  try{
    $pdo->beginTransaction();
    $sql = "DELETE FROM CommentReply where CommentID = ".$_POST['delete'];
    $delete = $pdo->prepare($sql);
    $delete->execute();
    $sql = "DELETE FROM Comments where CommentID = ".$_POST['delete'];
    $delete = $pdo->prepare($sql);
    $delete->execute();
    $pdo->commit();

  }catch(PDOException $e)
  {
    echo "IT BROKE";
    $pdo->rollback();
  }
}

if(isset($_POST['deleteReply']))
{

  try{
    $pdo->beginTransaction();
    $sql = "DELETE FROM CommentReply where CommentID = ".$_POST['deleteReply'];
    $delete = $pdo->prepare($sql);
    $delete->execute();
    $pdo->commit();

  }catch(PDOException $e)
  {
    echo "IT BROKE";
    $pdo->rollback();
  }
}


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
  //$_POST = array();
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
  //$_POST = array();
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
  //$_POST = array();
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
  //$_POST = array();
}
?>
<?php //this is how we add a comment to database
  if(isset($_POST['comment'])){
    try {
      $sql = "INSERT INTO Comments (UID, ImageID, Comment,Likes,Dislikes,Date) VALUES (?,?,?,?, ?, ?)";
      $pdo->beginTransaction();
      $commentUpST = $pdo->prepare($sql);
      $commentUpST->bindValue(1, $_SESSION['UID']);
      $commentUpST->bindValue(2, $_GET['img']);
      $commentUpST->bindValue(3, $_POST['comment']);
      $commentUpST->bindValue(4,0);
      $commentUpST->bindValue(5, 0);
      $commentUpST->bindValue(6, date("Y-m-d H:i:s"));
      $commentUpST->execute();
      $pdo->commit();
    } catch (PDOException $e) {
      $e->getMessage();
    }
    //$_POST = array();
  }
?>
<?php  //this is where we add reply to database
if(isset($_POST['reply']) && isset($_POST['replybtn'])){
  try {
    $sql = "INSERT INTO CommentReply (UID, CommentID, Comment,Likes,Dislikes,Date) VALUES (?,?,?,?, ?, ?)";
    $pdo->beginTransaction();
    $replyUpST = $pdo->prepare($sql);
    $replyUpST->bindValue(1, $_SESSION['UID']);
    $replyUpST->bindValue(2, $_POST['replybtn']);
    $replyUpST->bindValue(3, $_POST['reply']);
    $replyUpST->bindValue(4,0);
    $replyUpST->bindValue(5, 0);
    $replyUpST->bindValue(6, date("Y-m-d H:i:s"));
    $replyUpST->execute();
    $pdo->commit();
  } catch (PDOException $e) {
    $e->getMessage();
  }
  //$_POST = array();
}
?>
<?php //populate the comments
include 'connect.php';
try {
  if(isset($_POST['pop'])){
    $sql = "SELECT * FROM Comments WHERE ImageID = ? ORDER BY Likes-Dislikes DESC";
    $commentST = $pdo->prepare($sql);
    $commentST->bindValue(1, $_GET['img']);
    $commentST->execute();
  }else if(isset($_POST['best'])){//need to fix this one here
    $sql = "select * from (SELECT c.CommentID, c.UID, c.ImageID, c.Comment, c.Likes, c.Dislikes, c.Date, count(c.CommentID) as rep FROM Comments as c JOIN CommentReply as r ON c.CommentID=r.CommentID WHERE ImageID = ? GROUP BY CommentID) as monster ORDER BY rep+Likes-Dislikes DESC";
    $commentST = $pdo->prepare($sql);
    $commentST->bindValue(1, $_GET['img']);
    $commentST->execute();
  }else{
    $sql = "SELECT * FROM Comments WHERE ImageID = ? ORDER BY Date DESC";
    $commentST = $pdo->prepare($sql);
    $commentST->bindValue(1, $_GET['img']);
    $commentST->execute();
  }

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
  $pop = intval($commentTup['Likes'])-intval($commentTup['Dislikes']);
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
          <p> pop: '.$pop.'</p>
          <p class="pull-right">'.$numRep['replies'].' replies</p>
          ';
          if($commenterTup["UID"] == $_SESSION["UID"])
          {
            echo '<br><button type="submit" name="delete" value="'.$commentTup['CommentID'].'"> DELETE</button>';
          }
         echo '</form>
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
      $rpop = intval($replyTup['Likes'])-intval($replyTup['Dislikes']);
      echo '<div class="">
      <div class="replier-row">
      <div class="row">
        <p class="replycom"><span class="replier">'.$replierTup['Username'].':</span> '.$replyTup['Comment'].'</p>
      </div>
      <div class="row vote">
        <form class="" action="image.php?img='.$_GET['img'].'" method="post">
          <button type="submit" name="relike" value="'.$replyTup['ReplyID'].'">'.$replyTup['Likes'].' <span class="glyphicon glyphicon-thumbs-up"></span></button>
          <button type="submit" name="redislike" value="'.$replyTup['ReplyID'].'">'.$replyTup['Dislikes'].' <span class="glyphicon glyphicon-thumbs-down"></span></button>
          <p> pop: '.$rpop.'</p>
          ';
          if($replyTup["UID"] == $_SESSION["UID"])
          {
            echo '<br><button type="submit" name="deleteReply" value="'.$commentTup['CommentID'].'"> DELETE</button>';
          }
         echo '</form>
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
