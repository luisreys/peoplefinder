<?php
  $username = $_POST['user'];
  $password = $_POST['pass'];

  $mysqli = new mysqli("localhost", "root", "", "mvcex");
  if ($mysqli->connect_errno) {
    echo "Error #: " . $mysqli->connect_error;
    exit;
  }

  if ($stmt = $mysqli->prepare("SELECT * FROM servside2017_users WHERE user=? AND pwd=?")) {
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result->num_rows) {
      echo 'Username or password is wrong. <a href="login.php">Try again.</a>';

      $stmt->close();
      $mysqli->close();
      exit;
    }else {
      echo "Login successfully! Welcome " . $username;

      $rows=mysqli_fetch_assoc($result);
      /*while($row = $result->fetch_array(MYSQLI_ASSOC)){
        $rows[] = $row;
      }*/

      session_start();
      $_SESSION["username"] = $username;
      $_SESSION["pri"] = $rows["pri"];
      $_SESSION["id"] = $rows["id"];
      $_SESSION["description"] = $rows["description"];
      header("Location: index.php");
      $stmt->close();
      $mysqli->close();
      exit;
    }
  }
  $mysqli->close();
  exit;
 ?>
