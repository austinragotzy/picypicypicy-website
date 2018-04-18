<?php
session_start();

if(empty($_SESSION['loggedIn']))
{
    header('Location: login.php');
    exit;
}
$data[] = null;
if(isset($_GET['search']))
{
  include 'connect.php';
  $new = $_GET['search'];
  if($_GET['filter'] === "title")
  {
    $sql = "SELECT * FROM travelpost where Title LIKE '%$new%'";
  }
  else
  {
    $sql = "SELECT * FROM travelpost where Message LIKE '%$new%'";
  }

  $statement = $pdo->prepare($sql);

  $statement->execute();

  
  while($row = $statement->fetch())
  {
      $data[] = $row;
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
                <div class="panel-heading"><h3>Search</h3></div>
                    <div class="panel-body">
                    <form>
                        <div class="form-group">
                            <input type="search" name="search" class="form-control">
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="filter" value="title" checked> Find in Post Title</label><br/>
                            <lable> <input type="radio" name="filter" value="content"> Find in Post Content</label><br/>
                        </div>
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search</button>
                    </form>
                    </div>
                </div>  
                <!-- Search results go HERE -->

                <?php
                echo '
                <div class="panel panel-danger spaceabove">           
                <div class="panel-heading"><h4>Search results</h4></div>


                <div class="panel-body">
                ';
                if($data != null)
                {
                
                    foreach($data as $element)
                    {
                        echo '
                        <!-- Show the posts found in the search using this panel (one panel for each result) -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4><a href="post_single.php?id='.$element['PostID'].'">'.$element['Title'].'</a></h4>
                            </div>
                            <div class="panel-body">
                                '.$element['Message'].'
                            </div>
                        </div>
                        ';
                    }
                }
                else
                {
                echo '
                    <!-- If no results where found show this instead -->
                    <p>No results for search term <strong> SEARCH TERM </strong></p> ';
                }

                ?>
            </div>
        </div>  <!-- end main content column -->
    </div>  <!-- end main content row -->
</div>   <!-- end container -->





 <!-- Bootstrap core JavaScript
   ================================================== -->
   <!-- Placed at the end of the document so the pages load faster -->

 </body>
 </html>