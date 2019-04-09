<style>
	body{
	overflow: hidden;
}

</style>
<?php
session_start(); //Start the Session
if (isset($_POST['check'])) { //Check is it's already been set using POST.
$ur  = "admin"; // set variable of the username to admin
$pwd = "admin"; // set variable value of the PWD to admin
if ($_POST['username'] == $ur && $_POST['password'] == $pwd) {
$_SESSION['username'] = $ur; // set session from given user name, i.e admin
header('location:Dashboard.php'); //redirects to the Dashboard.php file
} else {
$error = "Error"; //Will produce the error message if the user enters the wrong username and password
  }
}
?> <!-- end of php -->
<html>
<head> <!-- Opening Head Tag -->
	<title>Login Page</title><!--Title for the Page, Displays in Browser Tab.-->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"><!--Link to the Boostrap
                                                                                                        Stt.-->
</head> <!-- Closing Head Tag -->
<body> <!-- Opening Body Tag -->
	<style>
	.col-centred { float: none; margin: 0 auto; }
	</style><!--In page styling, For ease of use.-->
	<?php //Initiate PHP.
	if (isset($error)) { //If user fails login and session variable cannot be set then follow next line.
	echo $error; //Echo $error.
	}
	?>
	<div class="row">
		<!--Div class row.-->
		<div class="col-sm-6 col-md-4 col-centred">
			<h2 style="margin-top: 255px; text-align: center;">Login Below, The PWD and UN = admin</h2>
			<form id="loginauth" method="post" name="loginauth" target="_self"> <!-- Posting the form data uisng POST. -->
				<!--Using the POST Method to send the data to the browser, Checking Username / PW once submitted.-->
				<div class="form-group">
					<!--Bootstrap Styling, Creating labels for the inputs and using classes from Bootstrap to style the forms.-->
					<label for="username"><span class="glyphicon glyphicon-user"></span> Username</label> <input class="form-control" name="username" placeholder="Enter username" style="text-align: center;" type="text">
				</div>
				<div class="form-group"> <!--Creating another DIV with the class of Form-Group-->
					<label for="password"><span class="glyphicon glyphicon-eye-open"></span> Password</label> <input class="form-control" name="password" placeholder="Enter password" style="text-align: center;" type="password">
				</div><button class="btn btn-success btn-block" name="check" type="submit"><span class="glyphicon glyphicon-off"></span>Login</button>
			</form>

		</div>
	</div>

</body> <!-- Closing Head Tag-->
</html>
