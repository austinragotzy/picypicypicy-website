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
    <title>Sign in</title>
  </head>
  <body>
    <?php include 'header.php'; ?>
    <body>
      <form class="" action="login.php" method="post">
        <input type="text" name="user" placeholder="username">
        <input type="password" name="pass" placeholder="password">
        <button type="submit" name="go"></button>
      </form>
    </body>
  </body>
</html>
