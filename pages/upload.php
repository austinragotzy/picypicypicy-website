<?php
session_start();

if(empty($_SESSION['loggedIn']))
{
    header('Location: login.php');
    exit;
}
if(isset($_GET["error"]))
{
    echo $_GET["error"];
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
        
      <div class="panel-heading" ><h4>User <?php echo $_SESSION['fName']." ".$_SESSION["lName"]  ?></h4></div>
      <div class="panel-body">
        <div class="row">
         <form action="uploadImage.php" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUpload"><br>
            <label for = "imageName">Image name:<input type = "text" name = "imageName" id = "imageName"><br>
            <label for = "imageDesc">Image Description:<input type = "text" name = "imageDesc" id = "imageDesc"><br>
            <br><input type="submit" value="Upload Image" name="submit">
        </form>
        </div>           
      </div>
        <br>
    </div>  <!-- end main content column -->
  </div> 

   <!-- end main content row -->
</div>   <!-- end container -->

   
 </body>
 </html>







