<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <link rel='stylesheet' href='style.css' type='text/css'>
  <title>Employees</title>
</head>

<body>

  <div class="container">
    <?php

    session_start();          // start session
    include('functions.php'); // include functions

    $user_type = check_user_type(); // check user type
    if ($user_type != 'admin') {    // if user type is not admin, user should not be able to access this page
      header('Location: home.php'); // return to home page
    }
    top_bar('home.php');            // display top bar with back button leading to home page
    ?>

    <input type="search" class="form-control" id="search" placeholder="Search..." onkeyup="search()">

    <table id="employees" class="table table-hover">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">First Name</th>
          <th scope="col">Last Name</th>
          <th scope="col"></th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <?php

        $json_file = 'employees-final.json'; // name of file containing employee data
        $json = load_file($json_file);       // load file
        $employee_data = decode_json($json); // decode json

        foreach ($employee_data as $employee) {  // iterate through employees
          $serialized_employee = json_encode($employee); // serialize employee
          echo '<tr scope="row">';
          echo '<td>'.$employee['id'].'</td>';        // display employee's id
          echo '<td>'.$employee['firstname'].'</td>'; // display employee's first name
          echo '<td>'.$employee['lastname'].'</td>';  // display employee's last name
          
          echo '<form method="post" action="edit_employee.php">';
          echo '<input type="hidden" name="employee" value=\''.$serialized_employee.'\'>'; // hidden input containing all the data for that employee
          echo '<td><button type="submit" class="btn btn-secondary" aria-label="Edit" data-toggle="tooltip" title="Edit employee">Edit</button></td>'; // button to edit employee
          echo '</form>';

          echo '<form method="post" action="delete_employee.php">';
          echo '<input type="hidden" name="employee-id" value="'.$employee['id'].'">'; // hidden input containing employee id
          echo '<td><button type="submit" class="btn btn-secondary" aria-label="Delete" data-toggle="tooltip" title="Delete employee">Delete</button></td>'; // delete employee button
          echo '</form>';

          echo '</tr>';
        }

        ?>
      </tbody>
    </table>

  </div>

  <script>

    //function adapted from https://www.w3schools.com/howto/howto_js_filter_table.asp
    function search() {
      // Declare variables
      var input, filter, table, tr, td, i, j, text_value, text_in_row;
      input = document.getElementById("search");
      filter = input.value.toUpperCase();
      table = document.getElementById("employees");
      tr = table.getElementsByTagName("tr");

      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        tds = tr[i].getElementsByTagName("td");
        text_in_row = false;

        for (j = 0; j < tds.length; j++) {
          text_value = tds[j].textContent || tds[j].innerText;
          if (text_value.toUpperCase().indexOf(filter) > -1) {
            text_in_row = true;
          }
        }

        if (tds.length > 0) {
          if (text_in_row) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
  </script>
  <script src='https://code.jquery.com/jquery-3.5.1.slim.min.js'
        integrity='sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj'
        crossorigin='anonymous'></script>
  <script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'
      integrity='sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo'
      crossorigin='anonymous'></script>
  <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js'
      integrity='sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI'
      crossorigin='anonymous'></script>
  <script src='https://kit.fontawesome.com/473e9d74d6.js' crossorigin='anonymous'></script>
</body>

</html>