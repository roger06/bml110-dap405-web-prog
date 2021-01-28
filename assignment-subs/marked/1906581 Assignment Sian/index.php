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

    <link rel="stylesheet" href="includes/style.css">

</head>

<body>

    <div class="wrapper">
        <form action="login.php" method="post" class="form-signin">
            <h2 class="form-signin-heading">Please login</h2>
            <p> Username: admin
                <br>
                Password: password
            </p>

            <input type="text" class="form-control" name="username" placeholder="Email Address" required="" autofocus="" />
            <br>
            <input type="password" class="form-control" name="password" placeholder="Password" required="" />
            <br>
            <button class="btn btn-lg btn-dark btn-block" type="submit">Login</button>
        </form>
    </div>



</body>


</html>
