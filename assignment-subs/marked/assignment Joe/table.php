<html class="no-js" lang="">

<head>
    <meta charset="utf-16">
    <title>Table</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">

    <meta name="theme-color" content="#fafafa">
</head>

<body>

    <?php
    include("payroll_function.php");

    $tax_file = file_get_contents("tax-tables.json");
    $tax_json = json_decode($tax_file, true);

    if ($tax_json === null && json_last_error() !== JSON_ERROR_NONE) {
        #https://www.geeksforgeeks.org/how-to-pop-an-alert-message-box-using-php/#:~:text=PHP%20doesn%E2%80%99t%20support%20alert%20message%20box%20because%20it,to%20alert%20the%20message%20box%20on%20the%20screen.
        exit('Error loading tax file');
    }


    $employee_file = file_get_contents("employees-final.json");
    $employee_json = json_decode($employee_file, true);

    if ($tax_json === null && json_last_error() !== JSON_ERROR_NONE) {
        exit('Error loading employee file');
    }

    displayTableFromEmployeeJson($employee_json, $tax_json);
    ?>


</body>

</html>

