<?php
  session_start();
  include 'connect.php';

  if($_SERVER["REQUEST_METHOD"] == "POST"){

    try {
      $userName = $_POST['user'];
      $pass = $_POST['pass'];//may have to hash

      $sql = "SELECT * FROM User WHERE UserName = ? and password = ?";
      $st = $pdo->prepare($sql);
      $st->bindValue(1, $userName);
      $st->bindValue(2, $pass);
      $st->execute();

      if($uAccount = $st->fetch()){
        $_SESSION['loggedIn'] = "yep";
        $_SESSION['UID'] = $uAccount['UID'];
        $_SESSION['userName'] = $uAccount['Username'];
        $_SESSION['pass'] = $uAccount['Password'];
        $_SESSION['email'] = $uAccount['Email'];
        $_SESSION['fName'] = $uAccount['FirstName'];
        $_SESSION['lName'] = $uAccount['LastName'];

        $_SESSION['date'] = $uAccount['DateOfRegistration'];

        header("location: index.php");

      }else {
        header("location: signUp.php");
      }
    } catch (PDOException $e) {
      die($e->getMessage());
    }

  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/home.css">
    <link rel="shortcut icon" href="images/icon.png" />
    <title>Sign in</title>
  </head>
  <body>
    <?php include 'header.php'; ?>
    <br>
    <main>
      <div class="container-fluid">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3>Log In Here</h3>
          </div>
          <div class="panel-body">
            <form class="" action="login.php" method="post"><br>
              <label for="user">Username</label><br>
              <input id="user" type="text" name="user" placeholder="username" required><br><br>
              <label for="pass">Password</label><br>
              <input id="pass" type="password" name="pass" placeholder="password" required><br><br>
              <button type="submit" name="">Go</button>
            </form>
          </div>
        </div>
      </div>
    </main>
    <?php include 'footer.php'; ?>
  </body>
</html>
