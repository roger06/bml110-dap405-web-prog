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
    
    session_start();
   
error_reporting(E_ALL);
ini_set('display_errors', 1);  
    
    require "includes/functions.php";  
     require "includes/header.php";
      
    
    ?>

</head>



<?php
    


 
$json_file = "data/employees-final.json"; // get employee data

$emp_json_data = file_get_contents($json_file);

$emp_array = json_decode($emp_json_data, true);



$tax_file = "data/tax-tables.json"; // get tax tables data

$taxfile = file_get_contents($tax_file); 

$taxjson = json_decode($taxfile, true);
    
    


    
    $empid = $_GET['id']; // shortens get id
    
    $emp_found = false;  // asigns variable to false (used later when error checking)
    
    
    
  if (!$empid) { // if there is no id entered...
    
    
    ?>

<div class="container">


    <div class="alert alert-danger">
        <strong>Id not found!</strong> <!-- alert message -->

    </div>
</div>

<?php    
      
      exit;  // exit script if no id is found in url 
  }
  
    

    foreach ($emp_array as $employee) { // for each employee...

  




    if ($employee["id"] != $empid) {
        
          continue; // if employee not found, continue to the next record
        
    }
        
        else {  // if employee is found then run html and display payslip
            
       $emp_found = true; // variable is true if employee is found
            
    $salary = $employee["salary"]; 
    $taxband = calculatetaxband($employee);
    $netsalary = calculatetax($employee, $taxband);
    $monthlywage = $netsalary/12;  

    ?>


<div class="container">

    <h1><?php echo $employee["firstname"]. ' '. $employee["lastname"] . "'s Payslip";?></h1>


    <?php
          
date_default_timezone_set('Europe/London');
$sTime = date("d-m-Y H:i");   

echo $sTime . "<br>"; // displays time and date

    
?>


    <div class="container my-3 bg-dark text-white border">
        <!-- emplfoyee details div -->
        <div class=" row">
            <div class="col">
                <H3>Employee details</H3>
                <p><?php echo " <b> Full Name: </b> " .  $employee["firstname"]. ' '. $employee["lastname"];?></p>
                <p><?php echo "<b> Employee ID: </b> " . $employee["id"];?></p>
                <p><?php echo "<b> Job Title: </b> " . $employee["jobtitle"];?></p>
                <p><?php echo "<b> Department: </b> " . $employee["department"];?></p>

            </div>
            <div class="col">
                <H3>Contact Information</H3>
                <p><?php echo " <b> Work Email: </b> " .  $employee["email"];?></p>
                <p><?php echo "<b> Personal Email: </b> " . $employee["homeemail"];?></p>
                <p><?php echo "<b> Phone Number: </b> " . $employee["phone"];?></p>
                <p><?php echo "<b> Address: </b> " . $employee["homeaddress"];?></p>
                <br>

            </div>
        </div>

    </div>


    <div class="container my-3 bg-dark text-white border">
        <!-- employee salary breakdown div -->
        <div class="row">
            <div class="col">
                <H3>Salary Breakdown</H3>

                <p><?php echo " <b> Tax Band: </b> " . "$taxband";?></p>
                <p><?php echo " <b> Gross Salary: </b> " .  "&pound" . number_format($employee['salary'], 2);?></p>
                <p><?php echo " <b> Net Salary: </b> " .  "&pound" . number_format($netsalary, 2);?></p>
                <p><?php echo " <b> Monthly Salary: </b> " .  "&pound" . number_format($monthlywage, 2);?></p>
            </div>



            <div class="col">
                <H3>Altered Salary</H3> <!-- Here users can input their own salary to see what their take home pay would be -->
                <form action="inputsalary.php" method="get">
                    <!-- super global variable GET collects data and sends to another page (inputsalary.php) -->
                    <p>Here you can enter a salary to see what you take home pay would be.</p>
                    <label for="userinput">Enter a salary...</label><br>
                    <input type="number" class="text-muted" name="userinput" placeholder="£" required>
                    <br>
                    <br>
                    <input type="checkbox" name="car">
                    <label for="car">Include Company Car?</label> <!-- if ticked, company car costs will be deducted too -->
                    <br>
                    <br>
                    <input class="bg-primary" type="submit">
                </form>
                <br>

            </div>
        </div>
    </div>

</div>



<?php
            
    break; // terminate loop once it is found
      
        } // end else statement (employee found)
   
} //end for each statement
    
    
    ?>

<div class="container my-3">

    <?php if (!$emp_found) { // if employee can't be found...
    
    ?>


    <div class="alert alert-danger">
        <strong>Employee not found!</strong> <!-- alert message -->
    </div>

    <?php
    
}
    
    
    ?>



    <a href='list.php'>
        <!-- this is just a link to take the user back to the previous page -->
        <h5>Back</h5>
    </a>

</div>

</html>
