<?php
  session_start();

  include 'connect.php';


  //get image and all info
  if(isset($_GET['img'])){
    try {
      $sql = "SELECT * FROM Image WHERE ImageID = ?";
      $st = $pdo->prepare($sql);
      $st->bindValue(1, $_GET['img']);
      $st->execute();
      if($imageTup = $st->fetch()){

      }else{
        header("location: index.php");
      }

      $sql = "SELECT * FROM User WHERE UID = ?";
      $st = $pdo->prepare($sql);
      $st->bindValue(1, $imageTup['UID']);
      $st->execute();
      $userTup = $st->fetch();

      $sql = "UPDATE Image SET ViewCount = ViewCount + 1 WHERE ImageID = ?";
      $likeUpST = $pdo->prepare($sql);
      $likeUpST->bindValue(1, $_GET['img']);
      $likeUpST->execute();
    } catch (PDOException $e) {
      die($e->getMessage());
    }

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
                            <td></td>
                          </tr>
                          <tr>
                            <td>Likes/Dislikes:</td>
                            <td><?php echo $imageTup['Likes'].'/'.$imageTup['Dislikes']; ?></td>
                          </tr>
                          <tr>
                            <td>views:</td>
                            <td><?php echo $imageTup['ViewCount']; ?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
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
