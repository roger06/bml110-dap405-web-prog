<?php
##################################################
#Loggs user out and destroys session variables   #
##################################################
ini_set('display_errors', '0');
session_start();
//$_SESSION["loggedin"] = false;
$_SESSION = array();
header("location: index.php");
?>