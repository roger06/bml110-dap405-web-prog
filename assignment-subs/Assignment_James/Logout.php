<?php   
//destroy all session data and return to login page
session_start();
session_unset();
session_destroy();
header("location: LoginPage.php")
?>

<?php

?>