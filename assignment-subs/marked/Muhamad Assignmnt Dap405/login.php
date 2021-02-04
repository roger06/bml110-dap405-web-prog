<?php
session_start();    // Session start
 
if(isset($_POST['submit']))    // Check form submit with IF Isset function
{
$username="admin";    // set variable value
$password="admin123";        // set variable value
if($_POST['username']==$username && $_POST['password']==$password)   // Check Given user name, password and Variable user name password are same
{
$_SESSION['username']=$username;    // set session from given user name
header('location:index.php');
}

else
{
$err="Login Failed Please Enter Correct Username and Password!";
}
}
?>
<html>
<head>
    <title> Login </title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>

<body>
<form  method="post" name="loginauth">
  <div class="cont">
    <div class="left-column">
      <label class="login-label">Username </label>
      <input type="text" placeholder="Enter Username" name="username" required></br>
      <label class="login-label">Password </label>
      <input type="password" placeholder="Enter Password" name="password" required>

    <button class="login-button" type="submit" name="submit">Login</button>
    </div>

    <div class="right-column">
         <h2 class="head-2-4">Admin Login: </h2>
         <h4 class="head-2-4">Username =  admin </h4>
         <h4 class="head-2-4">Password = admin123 </h4>
    </div>
  </div>
</form>
</body>
</html>