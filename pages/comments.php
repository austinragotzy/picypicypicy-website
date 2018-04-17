<?php

?>

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
        <details>
          <summary class="commenter-row">
            <div class="row cr">
              <p><span class="commenter">Brosef6969: </span>this chair is wrecked bro!</p><br>
            </div>
            <div class="row cr">
              <form class="" action="#" method="post">
                <p>19</p>
                <button type="submit" name="like" value="like"><span class="glyphicon glyphicon-thumbs-up"></span></button>
                <p>4</p>
                <button type="submit" name="dislike" value="dislike"><span class="glyphicon glyphicon-thumbs-down"></span></button>
                <p class="pull-right">4 replies</p>
              </form>
            </div>
          </summary>
          <div class="container-fluid">
            <div class="row replier-row">
              <p class="reply"><span class="replier">ronald51:</span> go home brosef</p>
            </div>
          </div><br>
          <form class="input-group reply" action="index.html" method="post">
            <div class="form-group">
              <input type="text" class="form-control" name="reply" rows="2" placeholder="what do YOU want to say to brosef6969"></input>
            </div>
              <div class="input-group-btn" style="height=100%;">
                <button class="btn btn-default" type="submit" name=""><span class="glyphicon glyphicon-pencil"></span>Submit<span class="glyphicon glyphicon-pencil"></span></button>
              </div>
          </form>
        </details><br>
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
