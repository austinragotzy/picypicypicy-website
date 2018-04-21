<?php  ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/comments.css">
    <title></title>
  </head>
  <body>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3>Comments</h3>
        <form class="" action="image.php?img=<?php echo $_GET['img']; ?>" method="post">
          <div class="btn-group">
            <button type="submit" name="new" class="btn btn-primary">Newest</button>
            <button type="submit" name="pop" class="btn btn-primary">Popularity</button>
            <button type="submit" name="best" class="btn btn-primary">Best</button>
          </div>
        </form>
      </div>
      <div class="panel-body">
        <?php include 'php/popComments.php' ?>
      </div>
    </div>
  </body>
</html>
