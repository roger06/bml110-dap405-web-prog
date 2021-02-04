<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Payroll Login Page</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- CSS for index -->
  <link href="index.css" rel="stylesheet">
  <!-- Link to PHP file to check user login details -->
  <?php require 'session_start.php'; ?>

</head>

<body class="text-center">

  <!-- Beginning of login form -->
  <main class="form-signin">
    <form method="post" action="index.php">
      <img class="mb-4" src="perk_logo.png" alt="logo for perk payroll system" width="200" height="200">
      <!-- Label for spacing -->
      <label for="username" class="visually-hidden"></label>
      <input type="text" id="username" name="username" class="form-control" placeholder="Username" required autofocus>
      <!-- Label for spacing -->
      <label for="password" class="visually-hidden"></label>
      <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
      <button class="w-100 btn btn-lg btn-primary" input type="submit">Sign in</button>
    </form>
    <!-- End of login form -->
  </main>


<h2>rh added   Admin / password</h2>


</body>

</html>