<?php
//• The first £10,000 of anyone’s income is tax free apart from company car users and those earning over £150,000 pa

//Get json file

//Open it

//Read it

//Convert it into an array

include "functions_1706134.php";

?> 

<html> 

<head>
     <link rel="stylesheet" href="tablecss.css">
 </head>

<body> 
<!-- created html tables + adding collum for text heading -->
<div class="htmltable">
  <h1 class="h1">Payslip</h1>
<table>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>ID</th>
        <th>Gross Pay</th>
        <th>Tax Due</th>
        <th>Net Pay</th>
        <th>Monthly Net Pay</th>
        <th>Company Car</th>
        <th>Payslip</th> 
        <th>Email</th>
    </tr>
    <!-- using foreach to loop through employee and pulling important data -->
    <?php foreach (fetchEmployees() as $employee){?>
        <tr>
        <!-- displaying specific employee information by pulling data within the array -->
            <td><?php print $employee["firstname"]; ?></td>
            <td><?php print $employee["lastname"]; ?></td>
            <td><?php print $employee["id"]; ?></td>
        <!-- displaying salary, calculated taxdue, salarytakehome and monthlynetpay via calling a fuction -->    
            <td><?php print "£" . number_format ($employee["salary"],2); ?></td>
            <td><?php print "£" . number_format(taxdue($employee),2); ?></td>
            <td><?php print "£" . number_format(salarytakehome($employee),2); ?></td>
            <td><?php print "£" . number_format(monthlynetpay($employee),2); ?></td>
            <td><?php print $employee["companycar"]; ?></td>
            <!-- <td><a href="http://192.168.64.2/dap405/dap405_final/employeepayslip_1706134.php?id=<?php print $employee["id"]; ?>">Payslip</a></td> -->
          
            <!-- line ammended by RH -->
            <td><a href="employeepayslip_1706134.php?id=<?php print $employee["id"]; ?>">Payslip</a></td>
          
            <td><form method="POST" action="email.php">
                <input type="hidden" name="employeeid" value="<?php print $employee["id"]; ?>">
                <input type="submit" value="Send Payslip">
                </form></td>
        </tr>
   <?php } ?>
</table>



<!-- printing php employee variable 
<td> <?php //print $employee["id"]; ?></td>-->

<?php
$to_email = "fabienthresher@gmail.com";
$subject = "Simple Email Test via PHP";
$body = "Hi,FN LN This is test email send by PHP Script";
$headers = "From: test@mydomain.com";

// Normal email:
// mail($to_email, $subject, $body, $headers)

// // Check if the email was sent:
// if (mail($to_email, $subject, $body, $headers)) {
//     echo "Email successfully sent to $to_email...";
// } else {
//     echo "Email sending failed...";
// }

?>



</body>

</html>

