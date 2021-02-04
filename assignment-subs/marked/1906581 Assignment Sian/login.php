<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <?php
   

session_start();

if (isset($_POST['username']) && isset($_POST['password'])) { // if the username and password is set
			$user = $_POST['username']; 
			$pass = $_POST['password'];

			if ($user == "admin" && $pass == "password") { // if username is equal to admin and password is equal to password
                
                session_start();  // begin session
       
                $_SESSION['username'] = Admin; // username = admin
      
                header('location:list.php'); // take them to the list
            
                
			}
			
    else {
        //login not completed 
        
?>

    <div class="container my-3">


        <div class="alert alert-danger">
            <strong>Error! You have entered and invalid email or password! <a href=index.php>Please try again</a></strong> <!-- alert message -->
        </div>

    </div>

    <?php
}


}










?>
