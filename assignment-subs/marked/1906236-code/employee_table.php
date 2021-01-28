<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
      integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <link rel='stylesheet' href='style.css' type='text/css'>
  <title>Employees</title>
</head>
<body>

  <div class="container-fluid">
    <?php 
        session_start();                // start session
        include('functions.php');       // include functions

        $user_type = check_user_type(); // get user type
        top_bar('home.php');
    ?>

  <table class="table table-hover">
    <thead class="thead-dark">
      <tr>
        <th scope="col">ID / Payslip</th>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">Department</th>
        <th scope="col">Line Manager</th>
        <th scope="col">Salary</th>
        <th scope="col">Tax</th>
        <th scope="col">Take-home Pay</th>
        <th scope="col">Company Car</th>
      </tr>
    </thead>
    <tbody>
      <?php

        $json_file = 'tax-tables.json';  // name of file containing tax data
        $json = load_file($json_file);   // load file
        $tax_table = decode_json($json); // decode json

        $json_file = 'employees-final.json'; // name of file containing employee data
        $json = load_file($json_file);       // load file
        $employee_data = decode_json($json); // decode json

        foreach($employee_data as $employee) { // iterate through employees
          $pay_data = calc_total($employee['salary'], $tax_table, $employee['currency'], $employee['companycar']); // calculate take home pay
          $employee = array_merge($employee, $pay_data); // add take home pay to employee array
          $serialized_employee = json_encode($employee); // serialize employee
          $currency_symbol = get_currency_symbol($employee['currency']); // get currency symbol for employee
          echo '<tr scope="row">';
          echo '<form method="post" action="payslip.php">';
          echo '<input type="hidden" name="employee" value=\''.$serialized_employee.'\'>'; // hidden input containing all the data for employee
          echo '<th><button type="submit" class="btn btn-primary" aria-label="Employee ID" data-toggle="tooltip" title="Open payslip">'.$employee['id'].'</button></th>'; // button to open payslip
          echo '</form>';
          echo '<td>'.$employee['firstname'].'</td>';                  // display employee's first name
          echo '<td>'.$employee['lastname'].'</td>';                   // display employee's last name 
          echo '<td>'.$employee['department'].'</td>';                 // display employee's department
          echo '<td>'.$employee['linemanager'].'</td>';                // display employee's line manager
          echo '<td>'.$currency_symbol.$employee['salary'].'</td>';    // display employee's salary
          echo '<td>'.$currency_symbol.$employee['tax'].'</td>';       // display employee's tax
          echo '<td>'.$currency_symbol.$employee['take_home'].'</td>'; // display employee's take home pay
          echo '<td>'.$employee['companycar'].'</td>';
          echo '</tr>';
        }

      ?>
    </tbody>
  </table>  

  </div>
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