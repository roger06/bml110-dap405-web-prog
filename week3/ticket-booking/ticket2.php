<!DOCTYPE html>
<html>
	<head>

         <title>Ticket booking :: step 2</title>

    </head>

    <body>
<?php

      

            $num_reqs = $_POST["tickets"];


            ?>
 <h2>You have requested <?php echo  $num_reqs;?> passports</h2>
            <p>Please enter the details below for each.</p>
        
        
            <form action="ticket3.php" method="post">
           


                <?php
                $count = 1;
                while ($count <= $num_reqs) {

                    echo  "<p>name ".$count." <input type=\"text\" name=\"applicant[]\">\r\n</p>";

                   

                  $count++;
                }

                ?>


            <input type="submit" name="submit">

        </form>

 

    </body>
</html>
