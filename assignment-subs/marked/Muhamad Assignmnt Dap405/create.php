<?php
// The require statement is used to copy a required content from the usersfunc file to this one. 
require 'usersfunc.php';
//An include statement is used to add the header of the page in just one seperate file which is used in all other php file.
include 'hf/header.php';
// error handling if id doesn't exits in super global GET then the program will throw a Not found error by reading a message on a specificed file and exit the program.

session_start();    //session start
if(!isset($_SESSION['username']))     //if session not found redirect to homepage
{
header('location:login.php');
} 


$employeedata = [
    'id' => '',
    'firstname' => '',
    'lastname' => '',
    'jobtitle' => '',
    'department' => '',
    'linemanager' => '',
    'email' => '',
    'phone' => '',
    'salary' => '',
    'dob' => '',
    'homeaddress' => '',
    'pension' => '',
    'companycar' => '',

];

$errors = [
    'id' => '',
    'firstname' => '',
    'lastname' => '',
    'jobtitle' => '',
    'department' => '',
    'linemanager' => '',
    'email' => '',
    'phone' => '',
    'salary' => '',
    'dob' => '',
    'homeaddress' => '',
    'pension' => '',
    'companycar' => '',
];
$isValid = true;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employeedata = array_merge($employeedata, $_POST);

    $isValid = validateEmployee($employeedata, $errors);

    if ($isValid) {
        $employeedata = createEmployee($_POST);

        header("Location: index.php");
    }
}

?>

<?php include 'form.php' ?>