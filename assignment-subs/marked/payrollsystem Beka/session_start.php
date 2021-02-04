
<?php
// Start user session
session_start();

// Check the posted data against the username and password stored
$username = "Admin";

// Password is bcrypted
$password = "5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8";

// Start logged_in session and redirect is username and password match
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    header("location: login.php");
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    if ($_POST['username'] == $username && sha1($_POST['password']) == $password) {
        $_SESSION['logged_in'] = true;
        header("location: login.php");
    }
}

?>