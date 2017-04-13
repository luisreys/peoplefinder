<?php
  include_once "db.php";
  /**
   *  Class User which saves all the information about the user who logged in.
   *  It also give to the user the chance to user some methods only for users.
   */
  class user{
    var $username = "";
    var $pri;
    var $id;
    var $description = "";
    function __construct($username, $pri, $id, $description)
    {
      $this->username = $username;
      $this->pri = $pri;
      $this->id = $id;
      $this->description = $description;
    }

    /*
    *   Add, Update and remove person.
    *   Return: 0 - Everything is okay
    *          -1 - Id doesn't exist in the DB
    *          -2 - Error in stmt->execute()
    *          -3 - Error in mysqli->prepare
    *          -4 - database connect error
    */
    function addPerson($id, $fname, $sname){
      return addPersonDB($id, $fname, $sname);
    }
    function updatePerson($id, $fname, $sname){
      return updatePersonDB($id, $fname, $sname);
    }
    function deletePerson($id){
      return deletePersonDB($id);
    }
  }


  /**
   *
   */
  class admin extends user
  {

    function __construct($username, $pri, $id, $description)
    {
      parent::__construct($username, $pri, $id, $description);
    }
    function addUser(){

    }
    function updateUser(){

    }
    function deleteUser(){
      
    }
  }

 ?>
