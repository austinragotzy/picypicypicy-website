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
      </div>
      <div class="panel-body">
        <?php include 'php/popComments.php' ?>
        <form class="input-group" style="width: 100%;" action="index.html" method="post">
          <div class="form-group">
            <input type="text" class="form-control" name="comment" rows="2" placeholder="how do YOU really feel"></input>
          </div>
            <div class="input-group-btn" style="height=100%;">
              <button class="btn btn-default" type="submit" name=""><span class="glyphicon glyphicon-pencil"></span>Submit<span class="glyphicon glyphicon-pencil"></span></button>
            </div>
        </form>
      </div>
    </div>
  </body>
</html>
