<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <link rel='stylesheet' href='style.css' type='text/css'>
  <title>Upload Tax</title>
</head>

<body>

  <div class="container">
    <?php

      session_start();
      include('functions.php');
      $user_type = check_user_type(); // get user type
      if ($user_type != 'admin') {    // if user type is not admin, user should not be able to access this page
        header('Location: home.php'); // return to home page
      }
      top_bar('home.php');            // display top bar with back button leading to home page

    ?>

    <form action="upload_tax.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="json_file">Tax JSON</label>
        <input type="file" accept="application/JSON" class="form-control" id="json_file" name="file">
      </div>
      <button type="submit" class="btn btn-primary" name="upload">Upload</button>
    </form>

    <?php

      if (isset($_POST['upload'])) {
        $errors = array();
        $type = $_FILES['file']['type'];                           // get file type from FILES variable
        if ($type != 'application/json') {                         // check file type is json
          $errors = array('File is not a JSON');                   // set errors
        } else {                                                   // file is of type json
          $errors = check_tax_json($_FILES['file']['tmp_name']);
        }

        if (empty($errors)) {
          move_uploaded_file($_FILES['file']['tmp_name'], 'tax-tables.json');
          echo '<div class="alert alert-success">Tax JSON updated</div>';     // display to user employee has been updated
        } else {
          echo '<div class="alert alert-danger">';
          foreach($errors as $error) {   // iterate through errors 
            echo $error.'<br>';          // display error
          }
          echo '</div>';
        }
      }

    ?>

    
  </div>

  <script src='https://code.jquery.com/jquery-3.5.1.slim.min.js' integrity='sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj' crossorigin='anonymous'></script>
  <script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js' integrity='sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo' crossorigin='anonymous'></script>
  <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js' integrity='sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI' crossorigin='anonymous'></script>
  <script src='https://kit.fontawesome.com/473e9d74d6.js' crossorigin='anonymous'></script>
</body>

</html>