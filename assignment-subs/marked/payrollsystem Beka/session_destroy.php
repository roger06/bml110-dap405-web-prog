<?php
// Initialize the session
session_start();

// Unset all of the session variables
unset($_SESSION['logged_in']);

// Destroy the session   
session_destroy();

// Return login page to when session ends to login again
header("Location: index.php");
exit;
?>





