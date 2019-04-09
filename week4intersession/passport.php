<!DOCTYPE html>
<html>
	<head>

        <title>Passport renewal</title>

    </head>

    <body>
<?php

        if ($_POST["submit"]) {  // user submits form with number

            $num_reqs = $_POST["passports"];


            ?>

            <form action="process.php" method="post">
            <h2>You have requested <?php echo  $num_reqs;?> passports</h2>
            <p>Please enter the details below for each.</p>


                <?php
                $count = 1;
                while ($count <= $num_reqs) {

                    echo  "<p>name ".$count." <input type=\"text\" name=\"applicant[]\"></p>\r\n";
                    // take out [] initially


                  $count++;
                }

                ?>


            <input type="submit" name="submit">

        </form>


        <?php

        }

        else {   // form called fist time
        ?>
            <form action="passport.php" method="post">

            <h1>How many passports do you want to renew?</h1>
            <input type="number" name="passports" style="width: 5%;"><br>

            <input type="submit" name="submit">

        </form>


        <?php
        }
        ?>


    </body>
</html>
