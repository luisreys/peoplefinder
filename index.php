<?php
include_once "controller/db.php";
session_start();
if(!isset($_SESSION['username'])){
 header("Location:search.php");
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

  </head>
  <body>
      <header>
        <div class="main-header">
        <div class="container">
          <div class="row">
              <div class="text-left col-md-6">
                <h2>Welcome <?php echo $_SESSION['username'] ?></h2>
              </div>
              <div class="text-right col-md-6">
                <span><a href="logout.php">Close session.</a></span>
              </div>
            </div>
          </div>
        </div>
      </header>
        <div class="container">
            <div class="row">
              <div class="result-table">
                <?php show_people(); ?>
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
