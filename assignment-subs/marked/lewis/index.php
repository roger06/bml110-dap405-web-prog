<!DOCTYPE html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="description"
        content="">
    <meta name="keywords" content="">
    <meta name="author" content="1906523">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <title>Payrol Logon Page</title>

    <link rel="stylesheet" type="text/css" href="style.css" />

    <script src="https://kit.fontawesome.com/b4f81ea84e.js" crossorigin="anonymous"></script>

</head>

<header>
<header>
<div class="container">
            <div class="row">
                <div class="col-4">
                    <h1>Payroll Solutions</h1>

                </div>
                <div class="col-4"></div>
           

            </div>

            <div class="row">
                <div class="col-6">
                    <p class="title">Payroll and Payslip system</p>
                </div>
                <div class="col-6"></div>

            </div>


        </div>

</header>
    </header>



<?php

session_start();//stats session so that session variables can be made/accessed 

$username = array("7265","3565","1360","9784","9140","6505","1532","6985","3021","2694","8114","7296","4213","4159","8861","9790","2499","8632","8734","9295", "admin");
$password = "password";
if(isset($_SESSION['login_complete']) && $_SESSION['login_complete'] == true ){
    header("Location: table.php");   //if already logged in and goes to index page it will default to going to the table.php page.

}

if(isset($_POST['username']) && isset($_POST['password'])){
        if (in_array($_POST['username'], $username) && $_POST['password'] == $password){//checks if the username is in the array list AND that the password is as well
        $_SESSION['login_account'] = $_POST['username'];//creates a session variable for the logged in user
        $_SESSION['login_complete'] = true;//sets log in complete to true to allow logging out later on 
        header("Location: table.php");//opens the table.php file
    }

}

?>


<html>

<body>
<main class="container">

<div class="row">
            <div class="col-12">
 <form method = "post" action="index.php">
 Username: <br>
 <input type="text" name="username"><br>
Password: <br>
<input type="password" name="password"><br>

<input type="submit" value="Login">
</form>
</div>
</main>




<h4>Usernames:</h4>
<?php
echo "All Access account is 'admin'"."<br>";
echo "Other accounts will show individual employee infomation"."<br>";
echo '<pre>';
print_r($username); //this is for testing purposes and would not be used in a live website
echo '</pre>'; //prints out usernames to make it easier to run

?>

<h4>Password is always 'password'</h4>

</body>


</hmtl>



