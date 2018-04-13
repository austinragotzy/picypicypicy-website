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
       <div class="panel-heading"><h4>User <?php /* echo $data['FirstName']." ".$data["LastName"]*/ ?>'s Profile Page</h4></div>
      
      <div class="panel-body">
        <div class="row">
          <div class="col-md-4">
            <div class="panel panel-primary">
              <div class="panel-heading"><h4>Login Details</h4></div>
              <ul class="list-group">
                <li class="list-group-item"><strong class="text-primary">Username</strong><br> <?php  ?> </li>
                <li class="list-group-item"><strong class="text-primary">Password</strong> 
                  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">
                    <span class="glyphicon glyphicon-eye-open"></span> Show
                  </button>
                  <div id="demo" class="d-inline collapse">
                    <?php  ?>
                  </div> </li>
                  <li class="list-group-item"><strong class="text-primary">User Since</strong><br>  <?php ?></li>
                </ul>
              </div>
            </div>
            <div class="col-md-4">
              <div class="panel panel-primary">
                <div class="panel-heading"><h4>User Information</h4></div>
                <ul class="list-group">
                  <li class="list-group-item"><strong class="text-primary">Name</strong><br> <?php echo $_SESSION["fName"]." ".$_SESSION["lName"]; ?> </li>
                  <li class="list-group-item"><strong class="text-primary">Address</strong><br> <?php  ?></li>
                  <li class="list-group-item"><strong class="text-primary">City, Country</strong><br> <?php  ?></li>
                  <li class="list-group-item"><strong class="text-primary">Phone</strong><br> <?php  ?> </li>
                  <li class="list-group-item"><strong class="text-primary">E-Mail</strong><br> <?php ?></li>
                  <li class="list-group-item"><strong class="text-primary">Privacy Setting</strong><br> <?php ?></li>
                </ul>
              </div>
            </div>

            <div class="col-md-4">
              <div class="panel panel-primary">
                <div class="panel-heading"><h4>User Activity</h4></div>
                <ul class="list-group">
                  <li class="list-group-item"><strong class="text-primary">Posts</strong><br> <?php  ?> posts </li>
                  <li class="list-group-item"><strong class="text-primary">Images</strong><br> <?php  ?> images</li>
                  <li class="list-group-item"><strong class="text-primary">Following</strong><br> 5 users</li>
                  <li class="list-group-item"><strong class="text-primary">Followed By</strong><br> 35 users </li>
                </ul>
              </div>
            </div>
          </div>
        </div>           
      </div>
        <br>

    </div>  <!-- end main content column -->

    <div class = "container">
        <div class="panel panel-danger spaceabove">           
        <div class="panel-heading"><h4>User <?php /* echo $data['FirstName']." ".$data["LastName"]*/ ?>'s Profile Page</h4></div>
        </div>
    </div>

  </div>  <!-- end main content row -->
</div>   <!-- end container -->





 <!-- Bootstrap core JavaScript
   ================================================== -->
   <!-- Placed at the end of the document so the pages load faster -->
   
 </body>
 </html>