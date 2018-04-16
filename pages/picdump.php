<?php
  session_start();


?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="bootstrap-3.2.0-dist/css/bootstrap.css">
    <title></title>
  </head>
  <body>
    <main class="container-fluid">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3>Pics!!</h3>
        </div>
        <div class="panel-body">
          <?php for ($i=0; $i <2 ; $i++) {
            echo '<div class="row">
              <div class="col-md-4">
                <div class="imgWrap">
                  <img class="img-rounded" src="images/brokeCar.jpg" alt="broken car">
                  <p class="imgDets">this car is busted <br>Owner: it aint mine</p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="imgWrap">
                  <img class="img-rounded" src="images/brokeChair.jpg" alt="broken chair">
                  <p class="imgDets">this chair is busted <br>Owner: it aint mine</p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="imgWrap">
                  <img class="img-rounded" src="images/brokeHouse.jpg" alt="broken house">
                  <p class="imgDets">this house is busted <br>Owner: ...that ones mine</p>
                </div>
              </div>
            </div><br>';
          }  ?>
        </div>
      </div>
    </main>
  </body>
</html>
