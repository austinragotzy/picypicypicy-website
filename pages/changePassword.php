<?php
session_start();

if(empty($_SESSION['loggedIn']))
{
    header('Location: login.php');
    exit;
}
include 'connect.php';
$message = null;

if($_SERVER["REQUEST_METHOD"] == "POST"){

    try
    {
        $sql = "UPDATE user SET password = ? where UID = ".$_SESSION["UID"];
        $st = $pdo->prepare($sql);
        $st->bindValue(1, $_POST["pass1"]);
        $st->execute();
        $message = "Password Changed";
    }
    catch (PDOException $e)
    {   
        $message = "Error with changing password";
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
       <div class="panel-heading"><h4><?php echo $_SESSION['fName']." ".$_SESSION["lName"]  ?>'s Page</h4></div>
      
      <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-primary">
              <div class="panel-heading"><h4>Change Password</h4></div>
                <ul class="list-group">
                    <form action = "changePassword.php" method = "POST">
                        <?php
                            if($message != null)
                            {
                                echo '<li class="list-group-item"><strong style="color:red;" class="text-primary">'.$message.'</strong> </li>';
                            }
                        ?>

                        <li class="list-group-item"><strong class="text-primary">New Password</strong><br> <input type = "text" name = "pass1" placeholder = "New Password"> </li>
                        
                        <li class="list-group-item"><strong class="text-primary">Submit</strong><br> <input type = "submit" value = "Change Password"> </li>
                    </form>
                </ul>
              </div>
            </div>
          </div>
        </div>           
      </div>
        <br>

    </div>  <!-- end main content column -->

    

  </div>  <!-- end main content row -->
</div>   <!-- end container -->





 <!-- Bootstrap core JavaScript
   ================================================== -->
   <!-- Placed at the end of the document so the pages load faster -->
   
 </body>
 </html>