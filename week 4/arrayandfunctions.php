<?php

function convertcaps($name){
    $name = strtoupper($name);
    return $name;
    
}

$studentsarray = array(
                        "Nathan",
                        "Mai",
                        "Ben", "Roger", "Josh", "Adele", "Alex");
foreach ($studentsarray as $name){
   // echo $name . "<br>";
    echo convertcaps($name) . "<br>";
    
}







?>