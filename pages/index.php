<?php
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/home.css">
    <title>picypicypicy</title>
  </head>
  <body>
    <?php include 'header.php'; ?>
    <main>
    <div class="container">
      <div class="col-md-2">  <!-- start left navigation rail column -->
        <?php include 'side.php'; ?>
      </div>  <!-- end left navigation rail --> 

      <div class="col-md-10">  <!-- start main content column -->
        <h1>Picyest Pics</h1>
        <div class="row">
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
        </div>
        <div style="margin-top: 1em;" class="panel panel-default">
          <div class="panel-heading">Picyest Tags</div>
          <div class="panel-body">
            <p>
              <a href="#">tag</a>,
              <a href="#">taggy</a>,
              <a href="#">taggle</a>,
              <a href="#">tags</a>
            </p>
          </div>
        </div>
      </div>
      </div>
    </main>
  </body>
</html>
