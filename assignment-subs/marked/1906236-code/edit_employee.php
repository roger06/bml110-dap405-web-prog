<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <link rel='stylesheet' href='style.css' type='text/css'>
  <title>Edit Employee</title>
</head>

<body>

  <div class="container">
    <?php

      session_start();                // start session
      include('functions.php');       // include functions
      $user_type = check_user_type(); // check user type
      if ($user_type != 'admin') {    // if user type is not admin, user should not be able to access this page
        header('Location: home.php'); // return to home page
      }
      if (!isset($_POST['employee'])) { // no employee set
        header('Location: list_employees.php');  // return to list employees page
      }
      top_bar('list_employees.php');  // display top bar with back arrow leading to employee list page

      if (isset($_POST['employee-id'])) {                                     // check employee id is set in POST variable
        list($employee, $invalid_fields) = validate_form($_POST['employee']); // validate form inputs
        $employee['id'] = $_POST['employee-id'];                              // add id to employee array
        if (empty($invalid_fields)) {                                         // if all inputs are valid
          update_employee_json($employee);                                    // update employee json with inputs
          echo '<div class="alert alert-success">Employee updated</div>';     // display to user employee has been updated
        }
      } else {                                               // employee id is not set meaning employee has not been updated yet
        $invalid_fields = array();                           // no invalid fields
        $employee = (array) json_decode($_POST['employee']); // employee is employee sent in POST
      }

      echo '<form class="form-background" method="post" action="edit_employee.php">';
      echo '<input type="hidden" type="number" name="employee-id" value="'.$employee['id'].'">'; // hidden input with value employee id

      edit_employee($employee, $invalid_fields); // create input fields containing employee's data

      echo '<button type="submit" class="btn btn-primary">Save changes</button>';
      echo '</form>';

    ?>

  </div>

  <script src='https://code.jquery.com/jquery-3.5.1.slim.min.js' integrity='sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj' crossorigin='anonymous'></script>
  <script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js' integrity='sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo' crossorigin='anonymous'></script>
  <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js' integrity='sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI' crossorigin='anonymous'></script>
  <script src='https://kit.fontawesome.com/473e9d74d6.js' crossorigin='anonymous'></script>
</body>

</html>