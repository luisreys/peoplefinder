<?php
include_once "model/db.php";
include_once "controller/user.php";
session_start();
if(!isset($_SESSION['username'])){
 header("Location:view/search.php");
}

$username = $_SESSION['username'];
$pri = $_SESSION['pri'];
$id = $_SESSION['id'];
$description = $_SESSION['description'];
if ($pri == 0) {
  $me = new user($username, $pri, $id, $description);
}else {
  $me = new admin($username, $pri, $id, $description);
}


if (isset($_POST['delete_form_user'])) {
  $user = $_POST['user'];
  $ret = $me->deleteUser($user);
  if ($ret!=0) {  //Remember to check errors here.
    echo "Something was wrong! <br>";
    echo "Error $ret: ";
    switch ($ret) {
      case -1:
        echo "ID doesn't exist in DB. <br>";
        break;
      case -2:
        echo "Error executing the statement. <br>";
        break;
      case -3:
        echo "Error preparing the SQL. <br>";
        break;
      case -3:
        echo "Internal error with DB. <br>";
        break;
      default:
        # code...
        break;
    }
    echo '<a href="javascript:history.back()">Go Back</a>';
    exit;
  }
}
if (isset($_POST['edit_form_user'])) {
  $user = $_POST['user'];
  $pwd = $_POST['pwd'];
  $pri = $_POST['pri'];
  $id = $_POST['id'];
  $description = $_POST['description'];
  $ret = $me->updateUser($user, $pwd, $pri, $id, $description);
  if ($ret!=0) {  //Remember to check errors here.
    echo "Something was wrong! <br>";
    echo "Error $ret: ";
    switch ($ret) {
      case -1:
        echo "ID doesn't exist in DB. <br>";
        break;
      case -2:
        echo "Error executing the statement. <br>";
        break;
      case -3:
        echo "Error preparing the SQL. <br>";
        break;
      case -3:
        echo "Internal error with DB. <br>";
        break;
      default:
        # code...
        break;
    }
    echo '<a href="javascript:history.back()">Go Back</a>';
    exit;
  }
}
if (isset($_POST['add_form_user'])) {
  $user = $_POST['user'];
  $pwd = $_POST['pwd'];
  $pri = $_POST['pri'];
  $id = $_POST['id'];
  $description = $_POST['description'];
  $ret = $me->addUser($user, $pwd, $pri, $id, $description);
  if ($ret!=0) {  //Remember to check errors here.
    echo "Something was wrong! <br>";
    echo "Error $ret: ";
    switch ($ret) {
      case -1:
        echo "ID doesn't exist in DB. <br>";
        break;
      case -2:
        echo "Error executing the statement. <br>";
        break;
      case -3:
        echo "Error preparing the SQL. <br>";
        break;
      case -3:
        echo "Internal error with DB. <br>";
        break;
      default:
        # code...
        break;
    }
    echo '<a href="javascript:history.back()">Go Back</a>';
    exit;
  }
}
/*
* FOR NORMAL PEOPLE
*/
if (isset($_POST['edit_form'])) {
  $id = $_POST['id'];
  $fname = $_POST['fname'];
  $sname = $_POST['sname'];
  $ret = $me->updatePerson($id, $fname, $sname);
  if ($ret!=0) {  //Remember to check errors here.
    echo "Something was wrong! <br>";
    echo "Error $ret: ";
    switch ($ret) {
      case -1:
        echo "ID doesn't exist in DB. <br>";
        break;
      case -2:
        echo "Error executing the statement. <br>";
        break;
      case -3:
        echo "Error preparing the SQL. <br>";
        break;
      case -3:
        echo "Internal error with DB. <br>";
        break;
      default:
        # code...
        break;
    }
    echo '<a href="javascript:history.back()">Go Back</a>';
    exit;
  }
}

if (isset($_POST['add_form'])) {
  $id = $_POST['id'];
  $fname = $_POST['fname'];
  $sname = $_POST['sname'];
  $ret = $me->addPerson($id, $fname, $sname);
  if ($ret!=0) {  //Remember to check errors here.
    echo "Something was wrong! <br>";
    echo "Error $ret: ";
    switch ($ret) {
      case -1:
        echo "ID doesn't exist in DB. <br>";
        break;
      case -2:
        echo "Error executing the statement. <br>";
        break;
      case -3:
        echo "Error preparing the SQL. <br>";
        break;
      case -3:
        echo "Internal error with DB. <br>";
        break;
      default:
        # code...
        break;
    }
    echo '<a href="javascript:history.back()">Go Back</a>';
    exit;
  }
}

if (isset($_POST['delete_form'])) {
  $id = $_POST['id'];
  $ret = $me->deletePerson($id);
  if ($ret!=0) {  //Remember to check errors here.
    echo "Something was wrong! <br>";
    echo "Error $ret: ";
    switch ($ret) {
      case -1:
        echo "ID doesn't exist in DB. <br>";
        break;
      case -2:
        echo "Error executing the statement. <br>";
        break;
      case -3:
        echo "Error preparing the SQL. <br>";
        break;
      case -3:
        echo "Internal error with DB. <br>";
        break;
      default:
        # code...
        break;
    }
    echo '<a href="javascript:history.back()">Go Back</a>';
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
    <link rel="stylesheet" href="./css/style.css">
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
                <span><a href="controller/logout.php">Close session.</a></span>
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
                  echo '<h2>Search</h2>';
                  show_ppl_by_search();
                }else {
                  echo '<h2>People list</h2>';
                  show_people();
                }
                ?>
              </div>
              <div class="result-table">
                <?php

                  if ($_SESSION['pri']) {
                    echo '<h2>Users list</h2>';
                    show_users();
                  }
                 ?>
              </div>
               <hr>
               <h2>Update person:</h2>
               <div class="text-left" class="myForm">
                   <form class="form-inline" action="index.php" method="post" >
                     <div class="form-group">
                       <label for="id">ID: </label>
                       <input type="text" name="id" value="" class="form-control input" required>
                     </div>
                     <div class="form-group">
                       <label for="fname">Name: </label>
                       <input type="text" name="fname" value="" class="form-control input" required>
                     </div>
                     <div class="form-group">
                       <label for="sname">Lastname: </label>
                       <input type="text" name="sname" value="" class="form-control input" required>
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
                       <input type="text" name="id" value="" class="form-control input" required>
                     </div>
                     <div class="form-group">
                       <label for="fname">Name: </label>
                       <input type="text" name="fname" value="" class="form-control input" required>
                     </div>
                     <div class="form-group">
                       <label for="sname">Lastname: </label>
                       <input type="text" name="sname" value="" class="form-control input" required>
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
                       <input type="text" name="id" value="" class="form-control input" required>
                     </div>
                     <input type="hidden" name="delete_form"  >
                     <input type="submit" class="btn btn-danger" name="" value="Delete">
                   </form>
                   <br>
               </div>
               <hr>
               <?php
               // 0 User
               // 1 Admin
                if ($me->pri == 1) {
                  echo '<hr>
                  <h2>Update user:</h2>
                  <div class="text-left" class="myForm">
                      <form class="" action="index.php" method="post" >
                        <div class="form-group col-md-4">
                          <label for="user">User: </label>
                          <input type="text" name="user" value="" class="form-control input" required>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="password">Password: </label>
                          <input type="password" name="pwd" value="" class="form-control input" required>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="pri">Priority: </label>
                          <select class="form-control" id="pri" name="pri" required>
                            <option selected disabled><b>Choose</b></option>
                            <option value="0">Normal User</option>
                            <option value="1">Admin</option>
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="id">ID: </label>
                          <input type="number" name="id" value="" class="form-control input" required>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="description">Description: </label>
                          <input type="text" name="description" value="" class="form-control input" required>
                        </div>
                        <input type="hidden" name="edit_form_user"  >
                        <div class="form-group col-md-4">
                        <p><br></p>
                          <input type="submit" class="btn btn-primary form-control" name="" value="Edit">
                        </div>
                      </form>
                      <br>
                  </div>

                  <h2>Add user:</h2>
                  <div class="text-left" class="myForm">
                  <form class="" action="index.php" method="post" >
                  <div class="form-group col-md-4">
                    <label for="user">User: </label>
                    <input type="text" name="user" value="" class="form-control input" required>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="password">Password: </label>
                    <input type="password" name="pwd" value="" class="form-control input" required>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="pri">Priority: </label>
                    <select class="form-control" id="pri" name="pri" required>
                      <option selected disabled><b>Choose</b></option>
                      <option value="0">Normal User</option>
                      <option value="1">Admin</option>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="id">ID: </label>
                    <input type="number" name="id" value="" class="form-control input" required>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="description">Description: </label>
                    <input type="text" name="description" value="" class="form-control input" required>
                  </div>
                  <input type="hidden" name="add_form_user"  >
                  <div class="form-group col-md-4">
                  <p><br></p>
                    <input type="submit" class="btn btn-info form-control" name="" value="Add">
                  </div>
                      </form>
                      <br>
                  </div>
                  <h2>Delete user:</h2>
                  <div class="text-left" class="myForm">
                      <form class="form-inline" action="index.php" method="post" >
                        <div class="form-group">
                          <label for="user">User: </label>
                          <input type="text" name="user" value="" class="form-control input" required>
                        </div>
                        <input type="hidden" name="delete_form_user">
                        <input type="submit" class="btn btn-danger" name="" value="Delete">
                      </form>
                      <br>
                  </div>';
                }

                ?>
            </div>
        </div>
        <hr>
  </body>
</html>
