<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <Link rel="stylesheet" href="styles/stylesheet.css" type = "text/css"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<?php
session_start();
session_unset();
session_destroy();
?>

   
<section  >
    <div class="d-flex align-items-start justify-content-start ">
<div id="formContent" >
<p >
Admin Login:<br>
UserName: Administrator<br>
UserLogin: Userxxxx<br>
xxxx: user id number in employee Json file<br>
Password is always Password
<p>

</div>
    </div>
<div class ="d-flex justify-content-center align-items-center " >
<div id="formContent"  >    
    <div class="first">
        <h2>Company Payroll</h2>
    </div>
<form method ="post" Action="Authentication.php">
      <input type="text" id="login" class="fadeIn second" name="username" placeholder="User Name">
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="Password">
      <input type="submit" class="fadeIn fourth" value="Log In">
    </form>  
<div class="mt-3">    
<?php
     if(key_exists("Error",$_GET)&&$_GET["Error"] == "True"):?>
        <p class="text-danger">Unknown User Details</p>
     <?php 
     elseif(key_exists("Error",$_GET)&&$_GET["Error"] == "permision"):?>
        <p class="text-danger">Permission not granted to that page</p>
     <?php endif;?>
</div>
     </div>
   
     </div>

</section>
</body>
</html>