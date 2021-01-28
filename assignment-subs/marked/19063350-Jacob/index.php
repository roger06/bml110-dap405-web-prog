<!DOCTYPE html>
<html lang="en">

<head>
    <title>Employee's Salary & Payslips</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <?php
    $json_file = "data/employees-final.json";

    $emp_json_data = file_get_contents($json_file);

    $emp_array = json_decode($emp_json_data, true);

        
    include('tax-band-functions.php'); //this includes the data from the functions file, so we can return the functions

    ?>
</head>
<?php 
    ?>

<body>
   <div class="container">
      <h2>Employee's Salary & Payslips</h2>
      <p>Please find a breakdown of your Salary and your Payslips below:</p>
      <table class="table">
            <tr>
               <th>ID</th>
               <th>First Name</th>
               <th>Last Name</th>
               <th>Email</th>
               <th>Company</th>
               <th>Gross Salary</th>
               <th>Net Salary</th>
                <th>Net Monthly Salary</th>
            </tr>
            <?php
            foreach($emp_array as $data) { //creating an array which generates each employees data
                ?>
                    <tr>
                    <td>
                  <a href='payslip.php?id=<?php echo $data['id']; ?>'><?php echo $data['id']; ?></a> <!-- This creates a clickable link for each employee that links them to their unique payslip -->
               </td>
                       <td><?php echo $data['firstname']; ?></td> <!-- this shows employees first name -->
                       <td><?php echo $data['lastname']; ?></td> <!-- this shows employees last name -->
                       <td><?php echo $data['email']; ?></td> <!-- this shows employees email -->
                       <td><?php echo strtoupper($data['companycar']); ?></td> <!-- this shows whether employee has a company car -->
                       <td><?php echo '£' . number_format($data['salary'], 2); ?></td> <!-- this shows employees gross salary -->
                       <td><?php echo '£' . number_format(finalaftertax($data['salary'], $data['companycar']), 2); ?></td> <!-- this shows employees net salary -->
                        <td><?php echo '£' . number_format(finalnetmonthly($data['salary'], $data['companycar']), 2); ?></td> <!-- this shows employees monthly net pay -->
                    </tr>
                    

                <?php
            }
            ?>
      </table>
   </div>
</body>

</html>