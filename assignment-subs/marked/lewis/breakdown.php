<!doctype html>
<html lang="en">

<head>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <title>Employee Breakdown</title>

    <link rel="stylesheet" type="text/css" href="style.css" />

    <script src="https://kit.fontawesome.com/b4f81ea84e.js" crossorigin="anonymous"></script>

</head>


<?php


session_start();

if (!isset($_SESSION['login_complete']) || $_SESSION['login_complete'] == false){
    header("Location: index.php");
}

$login_account = $_SESSION['login_account'];
$login_photo = $login_account . ".png";
//echo $login_photo
?>

<body>
    <header>
<?php 
include('header.php');
?>
    </header>


    <main class="container">
        <div class="row">
            <div class="col-12">
                <!-- https://www.w3schools.com/w3css/w3css_navigation.asp w3schools was used for research for the navbar strucutre-->
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="index.php">Menu</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-link" href="table.php">Home <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="profile_upload.php">Upload Picture</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="tax_tables.php">Tax Tables</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">Logout</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

        </div>
</main>





<?php

function breakdown_page(){

$userid = $_GET['userid'];



include 'tax_calc.php';

$str_data = file_get_contents("employees-final.json");
$data = json_decode($str_data, true);

if(!is_array($data)){
    throw new Exception('Could not decode the JSON');//looks for error
}

$jsonError = json_last_error();//gets data and assigns it to a variable 
if(is_null($data) && $jsonError == JSON_ERROR_NONE){//checks if array contains data
    throw new Exception('Could not decode JSON, file missing.');
}

if($jsonError != JSON_ERROR_NONE){
    $error = 'Could not decode JSON! ';
}
 
for($i = 0; $i < sizeof($data); $i++)
{
if($data[$i]["id"]==$userid){

    if($data[$i]["currency"]=="GBP"){
        //$currencysymbol = "&pound;";
        $currencysymbol = "£";
        } 
    elseif($data[$i]["currency"]=="USD"){
            $currencysymbol = "$";
            } 
            else{
                $currencysymbol = " ";
            }


    $first_name = $data[$i]["firstname"];
    $last_name = $data[$i]["lastname"];
    $email = $data[$i]["email"];
    $jobtitle = $data[$i]["jobtitle"];
    $ni_number = $data[$i]["nationalinsurance"];
    

    $image = $data[$i]["photo"];
    $address = $data[$i]["homeaddress"];

    $salary = $data[$i]["salary"];  //create variables to run the function
    $currency = $data[$i]["currency"];
    $companycar = $data[$i]["companycar"];
    
    $monthly_values = calc_tax($salary, $currency,$companycar); // gets data from function as an array
    $monthly_salary_rounded = $monthly_values[0]; //breaks array down into individual variables
    $monthly_tax_rounded = $monthly_values[1];
    
    $monthly_gross_salary = $salary / 12;
    $monthly_gross_salary = number_format((float)$monthly_gross_salary, 2, '.','');//rounds the gross monthly salary

    echo "Name: " . $first_name . " " . $last_name . "<br>";
    echo "Email: " . $email . "<br>";
    echo "Job Title: " . $jobtitle . "<br>";   
    echo "Monthly Gross Salary: " . $currencysymbol .  $monthly_gross_salary . "<br>";
    echo "Monthly Net Salary: " . $currencysymbol . $monthly_salary_rounded . "<br>";
    echo "Monthly Tax: " . $currencysymbol . $monthly_tax_rounded . "<br>";
    echo "<img src='photos/".$image."'id='testimage'>" . "<br>"; //outputs the data onto the page
    
    
    


    if(array_key_exists('button1', $_POST)) { 
        $payslip = array (
            array('First Name', 'Last Name', 'Job Title', 'Currency', 'Monthly Net Salary', 'Monthly Tax'),
            array($first_name, $last_name, $jobtitle, $currencysymbol, $monthly_salary_rounded, $monthly_tax_rounded),
            
        );
        
        $fp = fopen($userid . 'payslip.csv', 'w');
        
        foreach ($payslip as $fields) {//creates a CSV file with the date. Each array will appends to a row.
            fputcsv($fp, $fields);
        }
        
        fclose($fp);
    }
    


$_SESSION['payslip_data'] = array($address, $first_name, $last_name, $jobtitle, $currencysymbol, $monthly_salary_rounded, $monthly_tax_rounded, $salary, $companycar, $ni_number);//slight data risk having this as a session variables


} 



}
}
?>






<main class="container"> 

<div class="row">
            <div class="col-12">
                <h2>Monthly Take Home</h2>
                
                <?php breakdown_page();
                ?>

</div>
</div>


<div class="row">
            <div class="col-12">


<form method="post"> 
        <input type="submit" name="button1"
                class="button" value="Download Payslip (CSV)" /> 

</form> 

<br>


<form method="post" action="pdf_output.php"target="_blank">
  <input type="submit" value="Download Payslip (PDF)">
</form>
          

                </div>
</div>
</main>






<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
        crossorigin="anonymous"></script>


<footer>
<?php
include('footer.php');
?>

</footer>

    </body>



</html>



