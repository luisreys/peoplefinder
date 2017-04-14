<?php
include_once "controller/db.php";
include_once "user.php";
session_start();
if(!isset($_SESSION['username'])){
 header("Location:search.php");
}

$username = $_SESSION['username'];
$pri = $_SESSION['pri'];
$id = $_SESSION['id'];
$description = $_SESSION['description'];
$me = new user($username, $pri, $id, $description);

if (isset($_POST['edit_form'])) {
  $id = $_POST['id'];
  $fname = $_POST['fname'];
  $sname = $_POST['sname'];
  $ret = $me->updatePerson($id, $fname, $sname);
  if ($ret!=0) {  //Remember to check errors here.
    echo "Error $ret";
    exit;
  }
}

if (isset($_POST['add_form'])) {
  $id = $_POST['id'];
  $fname = $_POST['fname'];
  $sname = $_POST['sname'];
  $ret = $me->addPerson($id, $fname, $sname);
  if ($ret!=0) {  //Remember to check errors here.
    echo "Error $ret";
    exit;
  }
}

if (isset($_POST['delete_form'])) {
  $id = $_POST['id'];
  $ret = $me->deletePerson($id);
  if ($ret!=0) {  //Remember to check errors here.
    echo "Error $ret";
    exit;
  }
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

              <div class="text-center">
                <h1 id="searchagain">GLOOGE</h1>
              </div>
               <div class="text-center" class="myForm">
                   <form class="form-inline" action="index.php" method="post" >
                     <div class="form-group">
                       <input type="text" name="searchbox" value="" class="form-control input" placeholder="Find people">
                     </div>
                     <input type="submit" class="btn btn-primary" name="" value="Search">
                     <a href="index.php"><button type="button" class="btn btn-success" name="button">Show all</button></a>
                   </form>
                   <br>
               </div>

              <hr>
              <div class="result-table">
                <?php
                if (isset($_POST['searchbox'])) {
                  show_ppl_by_search();
                }else {
                  show_people();
                }
                ?>
              </div>

               <hr>
               <h2>Update person:</h2>
               <div class="text-left" class="myForm">
                   <form class="form-inline" action="index.php" method="post" >
                     <div class="form-group">
                       <label for="id">ID: </label>
                       <input type="text" name="id" value="" class="form-control input">
                     </div>
                     <div class="form-group">
                       <label for="fname">Name: </label>
                       <input type="text" name="fname" value="" class="form-control input">
                     </div>
                     <div class="form-group">
                       <label for="sname">Lastname: </label>
                       <input type="text" name="sname" value="" class="form-control input">
                     </div>
                     <input type="hidden" name="edit_form"  >
                     <input type="submit" class="btn btn-primary" name="" value="Edit">
                   </form>
                   <br>
               </div>

               <h2>Add person:</h2>
               <div class="text-left" class="myForm">
                   <form class="form-inline" action="index.php" method="post" >
                     <div class="form-group">
                       <label for="id">ID: </label>
                       <input type="text" name="id" value="" class="form-control input">
                     </div>
                     <div class="form-group">
                       <label for="fname">Name: </label>
                       <input type="text" name="fname" value="" class="form-control input">
                     </div>
                     <div class="form-group">
                       <label for="sname">Lastname: </label>
                       <input type="text" name="sname" value="" class="form-control input">
                     </div>
                     <input type="hidden" name="add_form"  >
                     <input type="submit" class="btn btn-info" name="" value="Add">
                   </form>
                   <br>
               </div>
               <h2>Delete person:</h2>
               <div class="text-left" class="myForm">
                   <form class="form-inline" action="index.php" method="post" >
                     <div class="form-group">
                       <label for="id">ID: </label>
                       <input type="text" name="id" value="" class="form-control input">
                     </div>
                     <input type="hidden" name="delete_form"  >
                     <input type="submit" class="btn btn-danger" name="" value="Delete">
                   </form>
                   <br>
               </div>
            </div>
        </div>
  </body>
</html>
