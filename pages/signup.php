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
      <br>
      <div class="container-fluid">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3>Sign Up Here</h3>
          </div>
          <div class="panel-body">
            <form action="signup.php" method="post">
              <label for="user">Username</label><br>
              <input id="user" type="text" name="user" placeholder="Username" required><br><br>
              <label for="pass">Password</label><br>
              <input id="pass" type="password" name="pass" placeholder="Password" required><br><br>
              <label for="email">Email</label><br>
              <input id="email" type="email" name="email" placeholder="Email" required><br><br>
              <label for="fname">First Name</label><br>
              <input id="fname" type="text" name="fName" placeholder="First Name" required><br><br>
              <label for="lname">Last Name</label><br>
              <input id="lname" type="text" name="lName" placeholder="Last Name" required><br><br>
              <button type="submit" name="">Submit</button>
            </form>
          </div>
        </div>
      </div>

    </main>
    <?php include 'footer.php'; ?>
  </body>
</html>
