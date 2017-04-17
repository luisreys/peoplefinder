<?php
session_start();
if(isset($_SESSION['username'])){
 header("Location:../index.php");
}
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="../css/loginStyle.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  </head>
  <body>
    <div class="frm">
      <form action="../controller/process.php" method="post">
        <div class="form-group">
          <label for="user">Username:</label>
          <input type="text" name="user" placeholder="User name" class="form-control">
        </div>
        <div class="form-group">
          <label for="pass">Password:</label>
          <input type="password" name="pass" placeholder="********" class="form-control">
        </div>
          <input type="submit" class="btn btn-success" value="Login">
      </form>
    </div>
  </body>
</html>
