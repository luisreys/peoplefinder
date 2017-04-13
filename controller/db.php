<?php

  function connectdb(){
    $mysqli = new mysqli("localhost", "root", "", "mvcex");
    if ($mysqli->connect_errno) {
      echo "Error #: " . $mysqli->connect_error;
      return null;
    }
    return $mysqli;
  }

  /*
  * This function show ppl by search.
  * Is the one which can be used for everyone.
  */
  function show_ppl_by_search(){
    if (isset($_POST['searchbox'])) {
      $str = $_POST['searchbox'];
    }else {
      echo '<h2 class="text-center">No results.</h2>';
      return;
    }
    $mysqli = connectdb();
    if ($mysqli == null) {
      return -4;
    }

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

/*
* Function which show all the people in the database.
* It is only for Users.
*/
function show_people(){
  $mysqli = connectdb();
  if ($mysqli == null) {
    return -4;
  }

  if ($stmt = $mysqli->prepare("SELECT * FROM servside2017_persons")) {
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result->num_rows) {
      //No hay resultados
      echo '<h2 class="text-center">Databse is empty.</h2>';
      $mysqli->close();
      return;
    }

    while($row = $result->fetch_array(MYSQLI_ASSOC)){
      $rows[] = $row;
    }

    echo '<div id="kryesore" style="overflow-y: scroll; height: 300px;"><table class="table"><thead>
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
</table></div>";

  }
  $result->free();
  $mysqli->close();
}

  /*
  * From here there are functions for Class methods.
  * First: addPerson, updatePerson and deletePerson
  */


  /*
  *   Add a person to the DB.
  *   Return: 0 - Everything is okay
  *          -1 - This person already exist, then, impossible to add again
  *          -2 - Error in stmt->execute()
  *          -3 - Error in mysqli->prepare
  *          -4 - database connect error
  */
  function addPersonDB($id, $fname, $sname){
    $mysqli = connectdb();
    if ($mysqli == null) {
      return -4;
    }

    // First I'm gonna check if this person already exist in the db
    if ($stmt = $mysqli->prepare("SELECT * FROM servside2017_persons WHERE id=?")) {
      $stmt->bind_param("i", $id);
      if (!$stmt->execute()) {
        $mysqli->close();
        return -2;
      }
      $result = $stmt->get_result();

      if (!$result->num_rows ) {
        // No result, then I can add the new person.

        if ($stmt = $mysqli->prepare("INSERT INTO servside2017_persons (id, fname, sname) VALUES (?, ?, ?)")) {
          $stmt->bind_param("iss", $id, $fname, $sname);
          if ($stmt->execute()){
            // Inserted
            $mysqli->close();
            return 0;
          }else {
            // No inserted
            $mysqli->close();
            return -2;
          }
        }else {
          $mysqli->close();
          return -3;
        }
      }else {
        // This person already exists
        $mysqli->close();
        return -1;
      }
    }else {
      $mysqli->close();
      return -3;
    }
  }

/*
*   Update a person on the DB.
*   Return: 0 - Everything is okay
*          -1 - Id doesn't exist in the DB
*          -2 - Error in stmt->execute()
*          -3 - Error in mysqli->prepare
*          -4 - database connect error
*/
  function updatePersonDB($id, $fname, $sname){
    $mysqli = connectdb();
    if ($mysqli == null) {
      return -4;
    }

    // First I'm gonna check if this person exist in the db
    if ($stmt = $mysqli->prepare("SELECT * FROM servside2017_persons WHERE id=?")) {
      $stmt->bind_param("i", $id);
      if (!$stmt->execute()) {
        $mysqli->close();
        return -2;
      }
      $result = $stmt->get_result();

      if (!$result->num_rows ) {
        // No result, then I can't update it.
        return -1;
      }else {
        // This person exists, then I can update the table.
        if ($stmt = $mysqli->prepare("UPDATE servside2017_persons SET id=?, fname=?, sname=? WHERE id=?")) {
          $stmt->bind_param("issi", $id, $fname, $sname, $id);
          if ($stmt->execute()){
            // Updated
            $mysqli->close();
            return 0;
          }else {
            // No Updated
            $mysqli->close();
            return -2;
          }
        }else {
          //Error in prepare sentence
          $mysqli->close();
          return -3;
        }
      }
    }else {
      //Error in prepare sentence
      $mysqli->close();
      return -3;
    }

    /*
    *   Delete a person to the DB.
    *   Return: 0 - Everything is okay
    *          -1 - Id doesn't exist in the DB
    *          -2 - Error in stmt->execute()
    *          -3 - Error in mysqli->prepare
    *          -4 - database connect error
    */
  }
  function deletePersonDB($id){
    $mysqli = connectdb();
    if ($mysqli == null) {
      return -4;
    }

/// First I'm gonna check if there are a person with this id, if it does, i can delete it
/// otherwise i can't delete anything.
    if ($stmt = $mysqli->prepare("SELECT * FROM servside2017_persons WHERE id=?")) {
      $stmt->bind_param("i", $id);
      if (!$stmt->execute()) {
        //Doesn't work
        $mysqli->close();
        return -2;
      }
      $result = $stmt->get_result();

      //I'm gonna check if there are some row
      if (!$result->num_rows) {
        //This id doesn't exist in the database. Then I can't remove it
        $mysqli->close();
        return -1;
      }else {
        //This id exist in the database, then, I can delete it

        if ($stmt = $mysqli->prepare("DELETE * FROM servside2017_persons WHERE id=?")) {
          $stmt->bind_param("i", $id);
          if (!$stmt->execute()) {
            //Something was wrong
            $mysqli->close();
            return -2;
          }else {
            //Deleted!
            $mysqli->close();
            return 0;
          }
        }else {
          //MYSQLI couldn't prepare it
          $mysqli->close();
          return -3;
        }
      }
    }else {
      $mysqli->close();
      return -3;
    }
  }
 ?>
