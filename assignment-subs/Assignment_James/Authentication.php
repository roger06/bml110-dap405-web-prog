<?php
session_start();
echo"post";
echo"<pre>";
print_r($_POST);
echo"</pre>";

include "LoginAuthenticator.php";


$userAuthentication = new LoginAuthenticator($EmpManager);
$usrnme = $_POST["username"];
$pswd = $_POST["password"];
$AuthenticatedUser = $userAuthentication->AuthenticateUser($usrnme,$pswd);


if($AuthenticatedUser == null|| $AuthenticatedUser->PermisionLevel == null){
    echo"null";
    header("Location: LoginPage.php");
    exit();    
}
else if ($AuthenticatedUser->PermisionLevel == "Administrator"){
    $_SESSION["USER"] = $AuthenticatedUser;
    header("location: AdminPage.php");
    exit();
}
else if($AuthenticatedUser->PermisionLevel == "User"){
    $_SESSION["USER"] = $AuthenticatedUser;
    
    if($AuthenticatedUser->Data == null){
        header("Location: LoginPage.php?Error=True");  
    }
  
    header("Location: UserPage.php");
   
    exit();
}

else{

    header("Location: loginPage.php?Error=True");
    exit();
}
?>