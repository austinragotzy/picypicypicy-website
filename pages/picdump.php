<?php
session_start();

if(empty($_SESSION['loggedIn']))
{
    header('Location: login.php');
    exit;
}

include 'getAllImages.php';

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

                foreach($images as $image)
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

            ?>
            </div>
          </div>
        </div>
      </div>
        <br>
    </div>  <!-- end main content column -->
  </div>
