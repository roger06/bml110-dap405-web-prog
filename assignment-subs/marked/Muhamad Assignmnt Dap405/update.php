<?php 
// The require statement is used to copy a required content from the usersfunc file to this one. 
require 'usersfunc.php';
//An include statement is used to add the header of the page in just one seperate file which is used in all other php file.
include 'hf/header.php';
// error handling if id doesn't exits in super global GET then the program will throw a Not found error by reading a message on a specificed file and exit the program.
session_start();    //session start
if(!isset($_SESSION['username']))     //if session not found redirect to login page
{
header('location:login.php');
} 

if (!isset($_GET['id'])){
    include "hf/error.php";
    exit;
} 
$employeeId = $_GET['id'];

//This will throw a Not found error by reading a message on a specificed file if the Employee ID is wrong and exit the program.
$employeedata = getEmployeeById ($employeeId);
if (!$employeedata){
    include "hf/error.php";
    exit; 
}


$errors = [
    'firstname' => "",
    'lastname' => "",
    'email' => "",
    'phone' => "",
    'homeaddress' => "",

];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employeedata = array_merge($employeedata, $_POST); //new record will be mergerd with the existing variable. 
    
    $isValid = validateEmployee($employeedata, $errors);

    if ($isValid) {
        $employeedata = updateEmployee($_POST, $employeeId);
        header ("Location: index.php"); // after updating the record sucessfully it will be redirected to home page.
    }    
}

?>

<?php include "form.php" ?>