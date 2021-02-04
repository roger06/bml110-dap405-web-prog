<?php

session_start();
$_SESSION['login_complete'] = false;
unset($_SESSION['login_account']);//removes session variable

header('Location: index.php');
exit;




?>
