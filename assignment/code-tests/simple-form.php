<?php

print_r($_POST);

?>
<!DOCTYPE html>
<html>
	<head>
        <meta charset="utf-8">


    </head>

    <body>
        <form method="post" action="simple-form.php">

        <input type="radio" name="resident" value="no" checked="true">Resident
        <input type="radio" name="resident"  value="yes">Non-Resident

        <input type="submit">
        </form>
    </body>
</html>

