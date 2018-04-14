<?php
session_start();

if(empty($_SESSION['loggedIn']))
{
    header('Location: login.php');
    exit;
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

 <!-- Google fonts used in this theme  -->
 <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700' rel='stylesheet' type='text/css'>
 <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic,700italic' rel='stylesheet' type='text/css'>  

 <!-- Bootstrap core CSS -->
 <link href="bootstrap3_bookTheme/dist/css/bootstrap.min.css" rel="stylesheet">
 <!-- Bootstrap theme CSS -->
 <!-- <link href="bootstrap3_bookTheme/theme.css" rel="stylesheet"> -->


 <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!--[if lt IE 9]>
   <script src="bootstrap3_bookTheme/assets/js/html5shiv.js"></script>
   <script src="bootstrap3_bookTheme/assets/js/respond.min.js"></script>
 <![endif]-->
</head>

<body>

  <?php include 'header.php'; ?>

  <div class="container">
   <div class="row">  <!-- start main content row -->

    <div class="col-md-2">  <!-- start left navigation rail column -->
     <?php include 'side.php'; ?>
   </div>  <!-- end left navigation rail --> 

   <div class="col-md-10">  <!-- start main content column -->

     <!-- Customer panel  -->
    <div class="panel panel-danger spaceabove">           
      <div class="panel-heading"><h4>User <?php echo $_SESSION['fName']." ".$_SESSION["lName"]  ?>'s Profile Page</h4></div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-6">
            <div class="panel panel-primary">
              <div class="panel-heading"><h4>Login Details</h4></div>
              <ul class="list-group">
                <li class="list-group-item"><strong class="text-primary">Username</strong><br> <?php echo $_SESSION["userName"];  ?> </li>
                <li class="list-group-item"><strong class="text-primary">Change Password</strong><br><button onclick="window.location.href = 'changePassword.php'" class="button" href="changePassword.php">Change Password</li>
                <li class="list-group-item"><strong class="text-primary">User Since</strong><br>  <?php echo $_SESSION["date"]; ?></li>
                </ul>
              </div>
            </div>
            <div class="col-md-6">
              <div class="panel panel-primary">
                <div class="panel-heading"><h4>User Information</h4></div>
                <ul class="list-group">
                  <li class="list-group-item"><strong class="text-primary">Name</strong><br> <?php echo $_SESSION["fName"]." ".$_SESSION["lName"]; ?> </li>
                  <li class="list-group-item"><strong class="text-primary">E-Mail</strong><br> <?php echo $_SESSION["email"]; ?></li>
                </ul>
              </div>
            </div>
          </div>
        </div>           
      </div>
        <br>

    </div>  <!-- end main content column -->
  </div> 

    <div class = "container">
    <div class="panel panel-danger spaceabove">           
      <div class="panel-heading"><h4>User <?php echo $_SESSION['fName']." ".$_SESSION["lName"]  ?>'s Pictures</h4></div>
      <div class="panel-body">
        <div class="row">

          <div class="col-md-4">
            <div class="panel panel-primary">
              <div class="panel-heading"><h4>Image</h4></div>
              <ul class="list-group">
        
                <img class = "text-center" style = "width:100%;" src = "images/brokeCar.jpg">
              </ul>
              </div>
            </div>
          </div>


        </div>           
      </div>
    </div>

   <!-- end main content row -->
</div>   <!-- end container -->





 <!-- Bootstrap core JavaScript
   ================================================== -->
   <!-- Placed at the end of the document so the pages load faster -->
   
 </body>
 </html>