<?php
session_start();
  include 'connect.php';

  try {
    $sql = "SELECT * FROM Image ORDER BY ViewCount DESC";
    $imgST = $pdo->prepare($sql);
    $imgST->execute();
  } catch (PDOException $e) {
    $e->getMessage();
  }
  $x = 0;
  //var_dump($imgST->fetch());
  while($row = $imgST->fetch()){
    if(!($row['Privacy']==="1")){
      $pic[] = $row;
      $x++;
    }
  }

  include 'toptags.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/home.css">
    <link rel="shortcut icon" href="images/icon.png" />
    <title>picypicypicy</title>
  </head>
  <body>
    <?php include 'header.php'; ?>
    <main><br>
    <div class="container">
      <div class="col-md-2">  <!-- start left navigation rail column -->
        <?php include 'side.php'; ?>
      </div>  <!-- end left navigation rail -->

      <div class="col-md-10">  <!-- start main content column -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2>Picyest Pics</h2>
          </div>
          <div class="panel-body">
            <div class="row">
              <?php
                for($i=0; $i<3; $i++){
                  $img = $pic[$i];
                  echo '<div class="col-md-4">
                    <a href="image.php?img='.$img['ImageID'].'" class="imgWrap">
                      <img class="img-rounded" src="images/'.$img['Path'].'" alt="'.$img['Title'].'" title="'.$img['Title'].'">
                    </a>
                  </div>';
                }
              ?>
            </div>
          </div>
        </div>
        <div style="margin-top: 1em;" class="panel panel-default">
          <div class="panel-heading">Picyest Tags</div>
          <div class="panel-body">
            <p class="tags">
              <?php
                for($i=0; $i<3; $i++) {
                  if($t = $topTags[$i])
                  echo '<a href="picdump.php?tag='.$t['TID'].'">'.$t['Tag'].'</a>,';
                }
              ?>
            </p>
          </div>
        </div>
      </div>
      </div>
    </main>
    <?php include 'footer.php'; ?>
  </body>
</html>
