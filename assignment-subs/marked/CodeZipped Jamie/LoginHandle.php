<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    $userName = $_POST["username"];
    $passWord = $_POST["password"];

    if ($passWord!="password")
    {
        header("Location: Login.php");
        die();
    }

    $jsonFilePath = "JSON/employees-final.json";
    $jsonEncoded = @file_get_contents($jsonFilePath);
    $jsonDecoded = json_decode($jsonEncoded, true);

    $counter = 0;

    foreach($jsonDecoded as $employee)
    {
        $idList[$counter] = $employee["id"];
        $counter += 1;
    }

    if ($userName=="admin") 
    {
        header("Location: List.php");
        die();
    }

    if (!in_array($userName, $idList) )
    {
        header("Location: Login.php");
        die();
    }
    else 
    {
        header("Location: Employee.php?id=" . $userName);
        die();
    }
?>  
</body>
</html>
