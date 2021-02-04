<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



    <?php
    
    session_start(); //start session


require "includes/functions.php"; 
    require "includes/header.php";

  
   ?>



</head>



<?php

$userinput = $_GET['userinput'];
$taxband = alttaxband();
$netsalary = altsalary($taxband);
$monthlywage = $netsalary/12;

?>

<div class="container bg-dark text-white border">
    <!-- employee salary breakdown div -->
    <div class=" row">
        <div class="col">
            <H3> Altered Salary Breakdown <?php echo "&pound" . number_format($userinput, 2);?></H3>

            <p><?php echo " <b> Tax Band: </b> " . "$taxband";?></p>
            <p><?php echo " <b> Gross Salary: </b> " .  "&pound" . number_format($userinput, 2);?></p>
            <p><?php echo " <b> Net Salary: </b> " .  "&pound" . number_format($netsalary, 2);?></p>
            <p><?php echo " <b> Monthly Salary: </b> " .  "&pound" . number_format($monthlywage, 2);?></p>

        </div>
    </div>
</div>



<div class="container my-3">

    <?php  
    
    $url = htmlspecialchars($_SERVER['HTTP_REFERER']);  //takes user back to previous page

    echo "<a href='$url'>
        <h5>Back</h5>
    </a>";

    ?>


</div>



</html>
