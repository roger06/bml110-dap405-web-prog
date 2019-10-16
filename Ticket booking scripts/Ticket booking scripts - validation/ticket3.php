<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

    // echo '<pre>';
    // print_r($_POST); // this is EVERTHING posted to our
    // echo '</pre>';




    $applicants = $_POST['applicant'];  // here we extract the array we want into another.

//    echo '<pre>';
//    print_r($applicants);
//    echo '</pre>';
    // count the number of tickets by determining the number of elements in the array
    $num_applications = count($applicants);

    /**
     * we could use this to calculate the total
     *  e.g $total = $ticket_price * $num_applications
     * or, we can calculate the total in the foreach loop below.
     */

    if ( count($applicants == 0)) $error_msg = 'No data to display';
    $error_count = 0;

    foreach (  $applicants as $applicant  ) {
    
        if (empty($applicant)) {
           $error_count++; 
            $error_msg =  $error_count . ' fields are empty';
        }  
      
      }

?>

<!DOCTYPE html>
<html>

<head>

    <title>Ticket buying</title>

</head>

<body>


    <h2>You have booked
        <?php echo $num_applications;?> tickets for...</h2>
    
    <table>
    
    <tr><th>&nbsp;</th><th>Name</th><th>Amount</th><th>Booking ref</th></tr>
    <?php
        

            $count = 1;
            $total_price = 0;
            foreach (  $applicants as $applicant  ) {
                
                
                 echo " <tr><td>$count</td><td>$applicant</td><td>&pound; 5</td><td>&nbsp;</td></tr>";
            
                $total_price += 5;
                // this means $total_price is $total_price plus £5 each time.

            $count++;
        }
        

    ?>
    </table>

    <p>The total price is &pound;<?php echo $total_price;?></p>
</body>
</html>