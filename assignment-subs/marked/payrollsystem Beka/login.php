<?php

// Redirect to homepage if username and password matched or back to login page if incorrect
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
    header ("location: index.php");
}
    else {
        
        header ("location: homepage.php");
}
