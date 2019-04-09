<?php
session_start(); //Starts a session to store variables, Used for security reasons to destroy password and Username.
if (!isset($_SESSION['username'])) //This checks if the session has been set, If it cannot find the session will redirect to the Homepage.
{
    header('location:Sessionover'); // Sends the user to the Sessionover.php which has the script to destroy the initiated session if there is one. If not just return home.

}
//echo $_SESSION['username']; I have kept this here for reference, I have moved it into the header.php file so the top of each webpage echos the logged in username.

?> <!--End of PHP-->

<!doctype html><!--For Intepreter use, Start of the Document type, Html-->
<html><!--Opening Html tag-->
<head><!--Opening Head tag-->
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Ensures site scales to mobile.-->
    <meta charset="utf-8"> <!--Using the Character set UTF-8-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"> <!-- Import the Ajax Bootstrap libary.-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script><!-- Import the Jquery libary.-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script><!-- Import the Bootstrap libary.-->
</head> <!--End of Head Tag.-->
<body><!--Opening Body Tag.-->

    <nav class="navbar navbar-default"><!--Create the NAVBAR-->
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="Dashboard.php">E-Payslips</a> <!--Links in navbar.-->
       <a class="navbar-brand" href="Dashboard.php">Employees</a><!--Links to the Dashboard view of employees.-->

    </div>
    <ul class="nav navbar-nav navbar-right">
         <li><a href="Sessionover.php">Click to Log-Out.</a></li> <!--If the user clicks logout, This will redirect them to the sessionover script,
                                                                      destroying Variables.-->
     </ul>
     <p class="navbar-text navbar-right">Hello, <?php echo $_SESSION['username']; //Identifies the active session if there is one and echos the username.?></p>
  </div>
</nav>
