<?php
session_start();
session_unset();
session_destroy();

header("Location: sessions2.php");



?>