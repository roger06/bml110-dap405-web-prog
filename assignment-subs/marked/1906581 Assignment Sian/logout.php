<?php

session_start();
session_destroy(); // log in session destroyed, no longer logged in
header('Location: index.php');
exit;


?>
