<?php
//setup comon classes form dependancy injection
include "EmployeeManager.php";


$configs =  new CompleteConfig();
$EmpManager = new EmployeeManager($configs);
function nameof($wantedVar) { 
    foreach($GLOBALS as $varName => $value) { 
        if ($value === $wantedVar) { 
            return $varName; 
        } 
    } 
    return null; 
} 


?>