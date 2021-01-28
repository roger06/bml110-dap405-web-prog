<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <link rel="stylesheet" href="style.css" type="text/css">
  <title>Login</title>
</head>

<body>

  <div class="container">
    <div class="row justify-content-center login-row">
      <div class="col-sm-6 align-self-center">
        <form class="form-background" method="post" action="index.php">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" id="username">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password">
          </div>

          <?php

            session_start(); // start session     
            include('functions.php'); // include functions

            if (array_key_exists('user_type', $_SESSION)) { // check if user type is already set
              $user_type = $_SESSION['user_type'];          // set variable user type
              if ($user_type == 'admin' || $user_type == 'standard') { // check user type is admin or standard
                header("Location: home.php");                          // if true, go to home page
              }
              
            } elseif (isset($_POST['username'])) {
              $username = $_POST['username']; // set username variable
              $password = $_POST['password']; // set password variable

              $user_type = handle_login($username, $password); // check user exists

              if ($user_type == 'invalid') {          // check if user type is invalid
                echo '<div class="alert alert-danger">Username or password incorrect</div>'; // display invalid login message
              } else {                                // user type is not invalid
                $_SESSION['user_type'] = $user_type;  // set user_type in SESSION variable
                header("Location: home.php");         // go to home page
              }
            }
            
          ?>

          <button type="submit" class="btn btn-primary">Submit</button>
          <div class="alert alert-secondary" role="alert">
            For the purpose of demonstration, please use:<br><br>
            Username: User<br>Password: password<br>to login as a standard user and<br><br>
            Username: Admin<br>Password: password<br>to login as an admin
          </div>
        </form>
      </div>
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