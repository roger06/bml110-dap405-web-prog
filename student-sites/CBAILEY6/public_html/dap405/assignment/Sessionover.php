<?php //Initiate PHP
session_start();
if(!isset($_SESSION['username'])) { //Determines if the username is logged in and the session variable has been set.
header('location:index.php');       //If it identifies that the user is logged in it will return them to the Index.php when they press logout.
}
unset($_SESSION['username']); //Finds the set username variables and unsets them
session_destroy();        // Kills the session destroying all stored variables
header('location:index.php'); // Redirect to the Index.php.
?><!-- End of PHP -->
