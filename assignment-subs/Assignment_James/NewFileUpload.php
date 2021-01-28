<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
include "Launch.php";
include "User.php"; 
session_start();
//check user has permision to run file
if(!(key_exists("USER",$_SESSION)) ||  $_SESSION["USER"]->PermisionLevel!="Administrator"){

    header("Location: LoginPage.php");
}
$newEmployeeData= $_FILES["employeedata"];
$fileName= $newEmployeeData["name"] ;

//if file type not json do not upload.
if(strtolower(pathinfo($fileName,PATHINFO_EXTENSION))!="json"){
    header("Location: AdminPage.php?Error=notJson");
}

//ensure no file is overwritten
else if(file_exists("data\\{$fileName}")){
    $count=0;
    $renameString= $fileName;
    while (file_exists("data\\{$renameString}")){
        $count+=1;
    $renameString = substr($fileName, 0,-5)."({$count}).Json";
    
    }
    $fileName=$renameString;
}
$fullLocation ="data\\{$fileName}";

//uplaod file
move_uploaded_file($newEmployeeData["tmp_name"],$fullLocation);
$datatype= key($_FILES);
//updae config and employee manager
$configs->UpdateConfig($datatype, $fullLocation);
$EmpManager->DataUpdate();
header("Location: AdminPage.php");
?> 
</body>
</html>

