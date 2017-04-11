<?php

  function connectdb(){
    $mysqli = new mysqli("localhost", "root", "", "mvcex");
    if ($mysqli->connect_errno) {
      echo "Error #: " . $mysqli->connect_error;
      exit;
    }
    return $mysqli;
  }

  function show_users(){
    $str = $_POST['searchbox'];
    $mysqli = connectdb();

    if ($stmt = $mysqli->prepare("SELECT * FROM servside2017_persons WHERE fname=? OR sname=?")) {
      $stmt->bind_param("ss", $str, $str);
      $stmt->execute();
      $result = $stmt->get_result();

      if (!$result->num_rows) {
        //No hay resultados
        echo '<h2 class="text-center">No results.</h2>';
        $mysqli->close();
        return;
      }

      while($row = $result->fetch_array(MYSQLI_ASSOC)){
        $rows[] = $row;
      }

      echo '<table class="table"><thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Lastname</th>
      </tr>
    </thead>
    <tbody>';
      foreach ($rows as $row){
        echo "<tr>";
            foreach ($row as $element){
                echo "<th>". $element."</th>";
            }
        echo "</tr>";
        }
        echo "</tbody>
  </table>";

    }
    $result->free();
    $mysqli->close();
  }

 ?>
