<?php
session_start();
session_unset();
$names = array("Joe", "Dave", "Bill");
$count = 1;
foreach ($names as $name){
    echo $name . "<br>";
    $_SESSION["name" . $count] = $name;
    $count ++;
}

echo "results below: <br>";
print_r($_SESSION);



session_destroy();
?>