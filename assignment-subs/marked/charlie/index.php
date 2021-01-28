
<!-- LOGN PAGE -->
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="Description" CONTENT="Pay records of ACME employees.">

    <title>ACME | Payroll </title>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Lobster&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="css/layout_style.css"/>
    <script src="https://kit.fontawesome.com/b12863e982.js" crossorigin="anonymous"></script>
</head>

<body>
    <div id="indexheader">
        <h1 id="indexlogo"><a href="process.php">ACME Pay</a></h1>
    </div>

<?php
ini_set('display_errors', '0');
session_start();

function userAuthorised($username, $password){
    require "getJson.php";
    foreach($employee_data_array as $employee){
        if ($username == $employee["id"] && $password==$employee["firstname"]){
            $_SESSION["user"] = $employee;
            return true;}
    }
    return false;   
}

//if already logged in redirect to the main page.
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
    header("location: process.php");
}
//if not logged in, try logging in and sending to the main page. 
elseif (isset($_POST["username"]) && isset($_POST["password"])){
    if (userAuthorised($_POST["username"], $_POST["password"])){
    $_SESSION["loggedin"] = true;
    header("location: process.php");
    }
}
?>

        <form id="login" method="post" action="index.php">
            <input type="text" id="username" name="username" value="8861">
            <input type="password" id="password" name="password" value="Faith">
            <input type="submit" id="loginbutt" value="Login">
        </form>
    </body>
</html>