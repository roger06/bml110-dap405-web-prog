<?php
include "functions_1706134.php";

//getting the id from the URL
$targetid = $_POST ["employeeid"];
//used foreach to run through each employee to match id in the URL
foreach (fetchEmployees() as $employee){

    //using if to compare the URL id with employee id
    if ($employee ["id"] == $targetid){
        //this is where I got to but the server didnt want to send emails
        //I didnt want to go further than this.
        //https://www.geeksforgeeks.org/how-to-configure-xampp-to-send-mail-from-localhost-using-php/
        //above didnt work.
        $to_email = "fabienthresher@gmail.com";
        $subject = "Simple Email Test via PHP";
        $body = "Hi,nn This is test email send by PHP Script";
        $headers = "From: test@mydomain.com";

    // Normal email:
        mail($to_email, $subject, $body, $headers);
    }


}


?>