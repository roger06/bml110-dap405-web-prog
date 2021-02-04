<?php

  session_start();                // start session
  include('functions.php');       // include functions 
  $user_type = check_user_type(); // get user type
  if ($user_type != 'admin') {    // if user type is not admin, user should not be able to access this page
    header('Location: home.php'); // return to home page
  }

  if (isset($_POST['employee-id'])) {  // if employee set
    $employee = $_POST['employee-id']; // get which employee to delete
    delete_employee($employee);     // delete employee
  }
  
  header("Location: list_employees.php"); // return to employee list page

?>