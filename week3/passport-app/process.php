<?php

    echo '<pre>';

        print_r($_POST); // this is EVERTHING posted to our

    echo '</pre>';




    $applicants = $_POST['applicant'];  // here we extract the array we want into another.

    echo '<pre>';
    print_r($applicants);
    echo '</pre>';

    $num_applications = count($applicants);

?>






<!DOCTYPE html>
<html>
	<head>

        <title>Passport renewal</title>

    </head>

    <body>


        <h2>You have renewed <?php echo $num_applications;?> passports</h2>

<?php

        if ($_POST["submit"]) {  // user submits form with number

            $num_reqs = $_POST["applicant"];


                }

                ?>






    </body>
</html>
