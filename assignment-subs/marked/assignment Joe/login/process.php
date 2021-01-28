<?php
require_once('config.php');
require_once('functions.php');
session_start();

if (!empty( $_POST ) ) {
     extract($_POST);

 
    
    if ( $user = in_array_r($username, $users) ) {
        if ( $user['password'] == $password ) {
            $_SESSION['user_id'] = $user['id'];
        }
    }
    header('Location: ../index.php'); exit;
} else {
    die('You done messed up now');
}