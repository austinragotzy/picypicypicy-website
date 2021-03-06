<?php
  session_start();

  include 'connect.php';
if(isset($_POST["addTag"]))
{
  if($_POST["addTag"] == "")
  {
    $error = "tag cannot be empty";
  }
  else
  {
    $sql = "SELECT * FROM Tags WHERE Tag = '".$_POST['addTag']."'";
    $tags = $pdo->prepare($sql);

    $tags->execute();

    if($row = $tags->fetch())
    {
      $sql = "SELECT * FROM ImageTags WHERE ImageID = ? AND TagID = ?";
      $tags = $pdo->prepare($sql);
      $tags->bindValue(1, $_GET['img']);
      $tags->bindValue(2,$row["TagID"]);
      $tags->execute();

      if(!$imageTag = $tags->fetch())
      {
        $sql = "INSERT INTO ImageTags (ImageID,TagID) VALUES (?,?)";
        $tags = $pdo->prepare($sql);
        $tags->bindValue(1, $_GET['img']);
        $tags->bindValue(2,$row["TagID"]);
        $tags->execute();
      }
    }
    else
    {
      $sql = "INSERT INTO Tags (Tag) VALUES (?)";
      $tags = $pdo->prepare($sql);
      $tags->bindValue(1, $_POST['addTag']);
      $tags->execute();

      $id = $pdo->lastInsertId();

      $sql = "INSERT INTO ImageTags (ImageID,TagID) VALUES (?,?)";
      $tags = $pdo->prepare($sql);
      $tags->bindValue(1, $_GET['img']);
      $tags->bindValue(2,$id);
      $tags->execute();

    }
  }



}
  if(isset($_POST['delete'])){
    if($_POST['delete']=="Delete Image")
    {
      $sql = "SELECT * from Comments where ImageID = ?";
      $comments = $pdo->prepare($sql);
      $comments->bindValue(1, $_GET['img']);
      $comments->execute();

      while($row = $comments->fetch())
      {
          $comment[] = $row;
      }

      foreach($comment as $deleteComment)
      {
        $sql = "DELETE FROM CommentReply where CommentID = ".$deleteComment["CommentID"];
        $delete = $pdo->prepare($sql);
        $delete->execute();

        $sql = "DELETE FROM Comments where CommentID = ".$deleteComment["CommentID"];
        $delete = $pdo->prepare($sql);
        $delete->execute();
      }

      $sql = "DELETE FROM ImageFavorite where ImageID = ?";
      $delete = $pdo->prepare($sql);
      $delete->bindValue(1, $_GET['img']);
      $delete->execute();

      $sql = "DELETE FROM Image where ImageID = ?";
      $delete = $pdo->prepare($sql);
      $delete->bindValue(1, $_GET['img']);
      $delete->execute();

      header("location: profile.php");

    }
  }



  if(isset($_GET["prv"]) and isset($_GET['img']))
  {

      $sql = "SELECT * FROM Image WHERE ImageID = ?";
      $st = $pdo->prepare($sql);
      $st->bindValue(1, $_GET['img']);
      $st->execute();
      $imageTup = $st->fetch();

    if(isset($_SESSION["UID"]) and $imageTup["UID"] == $_SESSION["UID"])
    {
      $sql = "UPDATE Image SET Privacy = ? WHERE ImageID = ?";
      $st = $pdo->prepare($sql);
      $st->bindValue(1, $_GET["prv"]);
      $st->bindValue(2, $_GET['img']);
      $st->execute();
    }
  }


  if(isset($_GET['img'])){
    try {//favorite checks and set/delete

      if(isset($_POST['fav'])){
        $sql = "SELECT * FROM ImageFavorite WHERE ImageID = ? and UID = ?";
        $favST1 = $pdo->prepare($sql);
        $favST1->bindValue(1, $_GET['img']);
        $favST1->bindValue(2, $_SESSION['UID']);
        $favST1->execute();
        //var_dump($favST1->fetch());
        if(!$favST1->fetch()){//if you havent already favorited the pic
          $sql = "INSERT INTO ImageFavorite (UID, ImageID) Values (?,?)";
          $pdo->beginTransaction();
          $makeFav = $pdo->prepare($sql);
          $makeFav->bindValue(1, $_SESSION['UID']);
          $makeFav->bindValue(2, $_GET['img']);
          $makeFav->execute();
          $pdo->commit();
        }
      }
      if(isset($_POST['unfav'])){
        $sql = "DELETE FROM ImageFavorite WHERE ImageID = ? and UID = ?";
        $pdo->beginTransaction();
        $takeFav = $pdo->prepare($sql);
        $takeFav->bindValue(1, $_GET['img']);
        $takeFav->bindValue(2, $_SESSION['UID']);
        $takeFav->execute();
        $pdo->commit();
      }
      $sql = "SELECT * FROM ImageFavorite WHERE ImageID = ? and UID = ?";
      $favST = $pdo->prepare($sql);
      $favST->bindValue(1, $_GET['img']);
      $favST->bindValue(2, $_SESSION['UID']);
      $favST->execute();
    } catch (PDOException $e) {
      $e->getMessage();
    }

    try {  //get image and all info
      if(isset($_POST['plike'])){
        $sql = "UPDATE Image SET Likes = Likes + 1 WHERE ImageID = ?";
        $pdo->beginTransaction();
        $likeUpST = $pdo->prepare($sql);
        $likeUpST->bindValue(1, $_GET['img']);
        $likeUpST->execute();
        $pdo->commit();
        $_POST = array();
      }else if(isset($_POST['pdislike'])){
        $sql = "UPDATE Image SET Dislikes = Dislikes + 1 WHERE ImageID = ?";
        $pdo->beginTransaction();
        $likeUpST = $pdo->prepare($sql);
        $likeUpST->bindValue(1, $_GET['img']);
        $likeUpST->execute();
        $pdo->commit();
        $_POST = array();
      }else{
        $sql = "UPDATE Image SET ViewCount = ViewCount + 1 WHERE ImageID = ?";
        $likeUpST = $pdo->prepare($sql);
        $likeUpST->bindValue(1, $_GET['img']);
        $likeUpST->execute();
      }
      $sql = "SELECT * FROM Image WHERE ImageID = ?";
      $st = $pdo->prepare($sql);
      $st->bindValue(1, $_GET['img']);
      $st->execute();
      if($imageTup = $st->fetch()){

      }else{
        header("location: index.php");
      }
      $imgPop = intval($imageTup['Likes'])-intval($imageTup['Dislikes']);

      $sql = "SELECT * FROM User WHERE UID = ?";
      $st = $pdo->prepare($sql);
      $st->bindValue(1, $imageTup['UID']);
      $st->execute();
      $userTup = $st->fetch();

    } catch (PDOException $e) {
      die($e->getMessage());
    }

    $sql = "SELECT * FROM ImageTags inner join Tags on ImageTags.TagId = Tags.TagID where ImageID = ?";
    $tagst = $pdo->prepare($sql);
    $tagst->bindValue(1, $_GET['img']);
    $tagst->execute();

    // while($tag = $st->fetch()){
    //   $imageTags[] = $tag;
    // }

  }else{
    header("location: index.php");
  }



?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/image.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="shortcut icon" href="images/icon.png" />
    <title>Image Page</title>
  </head>
  <body>
    <?php include 'header.php'; ?>
    <br>
    <div class="row">
      <div class="col-md-2">
        <?php include 'side.php'; ?>
      </div>
      <div class="container-fluid">
        <div class="col-md-10">
          <div class="row">
            <div class="panel panel-default">
              <div class="panel-heading"><h2>Pic</h2></div>
              <div class="panel-body">
                <div class="col-md-5">
                  <div class="imageBox">
                    <?php echo '<img class="img-rounded mainImg" src="images/'.$imageTup['Path'].'" alt="'.$imageTup['Title'].'" title="'.$imageTup['Title'].'">'; ?>
                  </div><br>
                  <div class="row vote">
                    <form class="" action="image.php?img=<?php echo $_GET['img'];?>" method="post">
                      <button type="submit" name="plike" value="like"><?php echo $imageTup['Likes']; ?> <span class="glyphicon glyphicon-thumbs-up"></span></button>
                      <button type="submit" name="pdislike" value="dislike"><?php echo $imageTup['Dislikes']; ?> <span class="glyphicon glyphicon-thumbs-down"></span></button>
                      <p> pop: <?php echo $imgPop; ?></p><br>
                      <?php
                        if($fav = $favST->fetch()){
                          echo '<button type="submit" name="unfav"><span class="glyphicon glyphicon-star-empty"></span>Unfavorite<span class="glyphicon glyphicon-star-empty"></span></button>';
                        }else {
                          echo '<button type="submit" name="fav"><span class="glyphicon glyphicon-star"></span>Favorite<span class="glyphicon glyphicon-star"></span></button>';
                        }
                      ?>
                    </form>
                  </div>
                </div>
                <div class="col-md-7">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4>Pic Details</h4>
                    </div>
                    <div class="panel-body">
                      <table class="table table-hover">
                        <tbody>
                          <tr>
                            <td>Description:</td>
                            <td><?php echo $imageTup['Description']; ?></td>
                          </tr>
                          <tr>
                            <td>Poster:</td>
                            <td><?php echo $userTup['FirstName'].' '.$userTup['LastName']; ?></td>
                          </tr>
                          <tr>
                            <td>Date Posted:</td>
                            <td><?php echo date('F d, Y', strtotime($imageTup['Date'])); ?></td>
                          </tr>
                          <tr>
                            <td>Tags:</td>
                            <td><?php
                            // var_dump($tagst->fetch());
                            while($tag = $tagst->fetch())
                            {
                              echo $tag["Tag"].", ";
                            }
                            ?></td>
                          </tr>
                          <tr>
                            <td>Likes/Dislikes:</td>
                            <td><?php echo $imageTup['Likes'].'/'.$imageTup['Dislikes']; ?></td>
                          </tr>
                          <tr>
                            <td>views:</td>
                            <td><?php echo $imageTup['ViewCount']; ?></td>
                          </tr>
                          <?php

                          if(isset($_SESSION["UID"]) and $imageTup["UID"] == $_SESSION["UID"])
                          {

                            echo '
                            <tr>
                              <td>Change Privacy:</td>';
                              if($imageTup["Privacy"] == 0)
                              {
                                  echo'<td><a href="image.php?img='.$imageTup["ImageID"].'&prv=1"  class="btn btn-info" role="button">
                                  <span class="glyphicon glyphicon-info-sign"></span> Change Image to Private
                                  </a>
                                  </td>
                                  ';
                              }
                              else
                              {
                                  echo'<td><a href="image.php?img='.$imageTup["ImageID"].'&prv=0" class="btn btn-info" role="button">
                                  <span class="glyphicon glyphicon-info-sign"></span> Change Image to Public
                                  </a>
                                  </td>
                                  ';
                              }

                            echo '</tr></form>
                            ';

                            echo'
                            <tr>
                              <td>Delete:</td>
                              <form method = "POST">
                                <td><input type = "submit" name = "delete" value = "Delete Image"></td>
                              </form>
                            </tr>
                            ';
                          }

                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>


            <div class="panel panel-danger spaceabove">
              <div class="panel-heading"><h4>Picture Tags</h4></div>
              <div class="panel-body">
                <div class="row">
                <?php echo'<form method = "POST" action =   "image.php?img='.$_GET["img"].'">'?>
                  <label for = "addLabel">Add Tag:</label>
                  <input type = "text" name = "addTag">
                  <input type = "submit">

                </div>
              </div>
            </div>

          <?php include 'comments.php'; ?>
        </div>
      </div>
      </div>

    <?php include 'footer.php'; ?>
  </body>
</html>
