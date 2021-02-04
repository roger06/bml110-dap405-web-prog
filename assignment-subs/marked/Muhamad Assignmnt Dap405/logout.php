<?php
session_start();
if(!isset($_SESSION['username']))     //if session not found redirect to homepage
{
header('location:login.php');
}
unset($_SESSION['username']);       // Session Found Unset the variable values
session_destroy();                  // Destroy the session
header('location:login.php');
?>