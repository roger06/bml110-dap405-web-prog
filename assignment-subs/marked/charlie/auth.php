<?php
#######################################################################
#This File Authourises certain credentials such as logged in, or      #
#redirects if searching for a non-existent user ID                    #
#######################################################################

ini_set('display_errors', '0');

$currentClearance = 0;//Default clearance is none.

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == false){
    header("location: error404.php");//Re-direct to Login Page if user not logged in or value un-set.
}
else{
    foreach($clearance_array as $clearance){
        if(isset($_SESSION["user"]["jobtitle"]) && in_array($_SESSION["user"]["jobtitle"], $clearance["jobtitles"])){
            $currentClearance = $clearance["clearance"];//potentially update clearance if the job role can be found in the clearance json file.
        }
    }
}

if (isset($_GET["id"]))//If using get to retrieve an employees page and the user ID does not exist, send to error page.
{
    $idNotInArray = true;

    foreach ($employee_data_array as $employee){
        if ($employee["id"] == $_GET["id"]){
            $idNotInArray = false;
            break;
        }
    }
    if($idNotInArray){ header("location: error404.php"); }
}    
?>