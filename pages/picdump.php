<?php
session_start();
 include 'getAllImages.php';
if(isset($_POST['search']))
{
  $images = null;
  include 'connect.php';
  $sql = "SELECT * FROM image inner join imagetags on image.ImageID = imagetags.ImageID inner join tags on imagetags.TagID = tags.TagID where tags.Tag = '".$_POST['search']."'";
  $imageST = $pdo->prepare($sql);
  $imageST->execute();

  while($row = $imageST->fetch())
  {
      $images[] = $row;
  }

}

if(!isset($_GET['fav'])){

}else {
  include 'connect.php';
  try {
    $images = null;
    $sql = 'SELECT * FROM ImageFavorite as f JOIN Image as i ON f.ImageID=i.ImageID WHERE f.UID=?';
    $imageST = $pdo->prepare($sql);
    $imageST->bindValue(1, $_SESSION['UID']);
    $imageST->execute();
    while($row = $imageST->fetch())
    {
        $images[] = $row;
    }
  } catch (PDOException $e) {
    $e->getMessage();
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
 <meta http-equiv="Content-Type" content="text/html;
 charset=UTF-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta name="description" content="">
 <meta name="author" content="">
 <link rel="shortcut icon" href="images/icon.png" />
 <title>Travel Journal</title>

 <link rel="shortcut icon" href="../../assets/ico/favicon.png">

</head>

<body>

  <?php include 'header.php'; ?>

  <div class="container"  style = "padding:10px;">
   <div class="row">  <!-- start main content row -->

    <div class="col-md-2">  <!-- start left navigation rail column -->
     <?php include 'side.php'; ?>
   </div>  <!-- end left navigation rail -->

   <div class="col-md-10">  <!-- start main content column -->

     <!-- Customer panel  -->
    <div class="panel panel-danger spaceabove" >

      <div class="panel-heading" ><h4>Browse Pictures</h4></div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
            <?php
              if($images)
              {
                foreach($images as $image)
                {
                  if($image["Privacy"] == 0)
                  {
                    echo'<div class="col-md-6 text-center">
                    <div class="thumbnail">
                        <a href = "image.php?img='.$image["ImageID"].'">
                        <img src = "images/'.$image["Path"].'" alt="'.$image['Title'].'" title="'.$image['Title'].'" class="img-thumbnail">
                        </a>
                        <div class="caption">
                        <p>
                            <a href="image.php?img='.$image["ImageID"].'">'.$image["Title"].'</a>
                        </p>
                        <p>
                            <a href="image.php?img='.$image["ImageID"].'" class="btn btn-info" role="button">
                            <span class="glyphicon glyphicon-info-sign"></span> View
                            </a>
                        </p>
                        
                        </div>
                    </div>
                    </div>';
                  }
              }
            }
            else
            {
              echo "NO IMAGES";
            }
                    
                
            ?>
            </div>
          </div>
        </div>
      </div>
        <br>
    </div>  <!-- end main content column -->
  </div>