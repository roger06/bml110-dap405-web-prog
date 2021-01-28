<html>
<head>
    <style>
        h1{font-size: 50px;}
    </style>
</head>
<body>
    <h1> Employee Information: </h1>
</body>
<?php
include "functions_1706134.php";



//getting the id from the URL
$targetid = $_GET ["id"];
//used foreach to run through each employee to match id in the URL
foreach (fetchEmployees() as $employee){
    //using if to compare the URL id with employee id
    if ($employee ["id"] == $targetid){

        foreach($employee as $key => $value){

            if(is_array($value)){
               //using string to upper to make the key string uppercase. 
               //using implode to join array elements with a string
                print mb_strtoupper($key) . ": " . implode(", ",$value) . "<br>";
            }else {print mb_strtoupper($key) . ": " . $value . "<br>";}
        }
        print "MONTHYNETPAY: £" . number_format(monthlynetpay($employee),2);
    } 
}

?>

</html>