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
        
        
            <form action="ticket3.php" method="POST">
           


                <?php
                $count = 1;
                while ($count <= $num_reqs) {

                    echo  "<p>name ".$count." <input type=\"text\" name=\"applicant[]\">\r\n";

                    echo "<select name=\"type[]\">
                        <option value=\"adult\">Adult (&pound;10)</option>
                        <option value=\"child\">Child (&pound;5)</option>
                        <option value=\"family\">Family (&pound;30)</option>
                        <option value=\"student\">Student (&pound;6)</option>
                    </select> </p>";

                  $count++;
                }

                ?>


            <input type="submit" name="click me!">

        </form>

 

    </body>
</html>
