<?php
  session_start();

  include 'connect.php';

  if($_SERVER["REQUEST_METHOD"] == "POST"){

    try {
      $userName = $_POST['user'];
      $password = $_POST['pass'];

      $sql = "SELECT * FROM User WHERE UserName = ? and password = ?";
      $st = $pdo->prepare($sql);
      $st->bindValue(1, $userName);
      $st->bindValue(2, $pass);
      $st->execute();
      var_dump($st);
      if(!$st->fetch()){
        $email = $_POST['email'];
        $fName = $_POST['fName'];
        $lName = $_POST['lName'];
        $pdo->beginTransaction();
        $sql = "INSERT INTO User (Username, Password, Email, FirstName, LastName) VALUES (?, ?, ?, ?, ?)";
        $st = $pdo->prepare($sql);
        $st->bindValue(1, $userName);
        $st->bindValue(2, $password);
        $st->bindValue(3, $email);
        $st->bindValue(4, $fName);
        $st->bindValue(5, $lName);
        $st->execute();
        $pdo->commit();
        header("location: login.php");
      }else{
        header("location: signUp.php");
      }
    } catch (PDOException $e) {
        $e->getMessage();
    }

  }

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Sign Up</title>
  </head>
  <body>
    <?php include 'header.php' ?>
    <main>
      <form action="signup.php" method="post">
        <input type="text" name="user" placeholder="Username"><br>
        <input type="password" name="pass" placeholder="Password"><br>
        <input type="email" name="email" placeholder="Email"><br>
        <input type="text" name="fName" placeholder="First Name"><br>
        <input type="text" name="lName" placeholder="Last Name"><br>
        <button type="submit" name="">Submit</button>
      </form>
    </main>
  </body>
</html>
