<?php
include_once "controller/db.php";
  if (!isset($_POST['searchbox'])) {
    header("Location:search.php");
  }
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <header>
      <div class="main-header">
      <div class="container">
        <div class="row">
            <div class="text-left col-md-6">
              <h2>Welcome</h2>
            </div>
            <div class="text-right col-md-6">
              <span><a href="login.php">Login</a></span>
            </div>
          </div>
        </div>
      </div>
    </header>
      <div class="container">
          <div class="row">
            <div class="result-table">
              <?php show_users(); ?>
            </div>
            <hr>
            <div class="text-center">
              <h1 id="searchagain">GLOOGE</h1>
            </div>
             <div class="text-center" id="myForm">
                 <form class="form-inline" action="result.php" method="post" >
                   <div class="form-group">
                     <input type="text" name="searchbox" value="" class="form-control input">
                   </div>
                   <input type="submit" class="btn btn-primary" name="" value="Search">
                 </form>
             </div>
          </div>
      </div>
  </body>
</html>
