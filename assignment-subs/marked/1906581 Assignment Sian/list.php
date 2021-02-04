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

$json_file = "data/employees-final.json"; // get employee data

$emp_json_data = file_get_contents($json_file);

$emp_array = json_decode($emp_json_data, true);



$tax_file = "data/tax-tables.json"; // get tax tables data

$taxfile = file_get_contents($tax_file);

$taxjson = json_decode($taxfile, true);
    



require "includes/header.php";
require "includes/functions.php"; 

  
   ?>


   </head>

   <body>

       <div class="container">
           <h2>Employees</h2>

           <table class="table table-hover">
               <!-- table to display list of employees -->
               <thead>
                   <tr>
                       <th>ID</th>
                       <th>First Name</th>
                       <th>Surname</th>
                       <th>Tax Band</th>
                       <th>Gross Salary</th>
                       <th>Net Salary</th>
                       <th>Monthly Salary</th>
                   </tr>
               </thead>
               <tbody>

                   <?php
        
        foreach ($emp_array as $employee) { // for each employee...

                
                
                $salary = $employee["salary"]; // use $salary to simplify
                $taxband = calculatetaxband($employee); // calculate taxband function
                $netsalary = calculatetax($employee, $taxband); // calculate tax function, using taxband function
                $monthlywage = $netsalary/12; // monthly wage is net salary/12
    ?>
                   <tr>
                       <td>
                           <a href="payslip.php?id=<?php echo $employee['id'];?>"><?php echo $employee['id'];?></a>
                       </td> <!-- ? feeds parameter through so each id is different-->
                       <td><?php echo $employee['firstname'];?></td>
                       <td><?php echo $employee['lastname'];?></td>
                       <td><?php echo $taxband;?></td>
                       <td><?php echo "&pound" . number_format($employee['salary'], 2);?></td>
                       <td><?php echo "&pound" . number_format($netsalary, 2);?></td>
                       <td><?php echo "&pound" . number_format($monthlywage, 2);?></td>
                   </tr>


                   <?php 
                                          
                    } // end for each loop
                
                ?>

               </tbody>




           </table>


       </div>



   </body>

   </html>
