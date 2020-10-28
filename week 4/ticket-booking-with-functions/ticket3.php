<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

    echo '<pre>';
    print_r($_POST); // this is EVERTHING posted to our
    echo '</pre>';




    $applicants = $_POST['applicant'];  // here we extract the array we want into another.

//    echo '<pre>';
//    print_r($applicants);
//    echo '</pre>';

    $num_applications = count($applicants);


// functions

/* generate a booking ref  */
function getBookingRef($applicant) {
    
    // get first three letters of name
    $ref = substr($applicant, 0, 3);
    
    // use timestamp
   // $ref .= substr(time(), 0,5);
    
    // then add a random integer
    $ref .= random_int (999, 9999999 );
    
    return $ref;
}


?>






<!DOCTYPE html>
<html>

<head>

    <title>Passport renewal</title>

</head>

<body>


    <h2>You have booked
        <?php echo $num_applications;?> tickets for...</h2>
    
    <table>
    
    <tr><th>&nbsp;</th><th>Name</th><th>Amount</th><th>Booking ref</th></tr>
    <?php
        
//        while ($count <= $num_applications) {
            $count = 1;
            foreach (  $applicants as $applicant  ) {
            
                 $ref = getBookingRef($applicant) ;      
                
                 echo " <tr><td>$count</td><td>$applicant</td><td>&pound; 5</td><td>$ref</td></tr>";
            
            
            $count++;
        }
        

    ?>

        
        
    
    </table>

    





</body>

</html>