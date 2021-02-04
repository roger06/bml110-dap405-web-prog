<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <link rel='stylesheet' href='style.css' type='text/css'>
  <title>Home</title>
</head>

<body>

  <?php
    session_start();          // start session
    include('functions.php'); // include functions

    $user_type = check_user_type(); // check user type
  ?>

  <div class="container">
    <div class="row top-bar">
      <?php
        logout(); // display logout button
      ?>
    </div>

    <div class='row'>
      <div class='col-xl-3 col-lg-4 col-sm-6'>
        <a href='employee_table.php' class='card-link'>
          <div class='card'>
            <div class='card-body'>
              <h5 class='card-title'>Employee Table</h5>
            </div>
          </div>
        </a>
      </div>
      <?php
      if ($user_type == 'admin') { // if user is admin display admin only links
        echo '
        <div class="col-xl-3 col-lg-4 col-sm-6">
          <a href="list_employees.php" class="card-link">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Edit Employees</h5>
              </div>
            </div>
          </a>
        </div>
        <div class="col-xl-3 col-lg-4 col-sm-6">
          <a href="upload_tax.php" class="card-link">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Upload Tax JSON</h5>
              </div>
            </div>
          </a>
        </div>';
      }
      
      ?>
    </div>
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
</body>

</html>