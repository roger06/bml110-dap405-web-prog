<html>
    <head>
        <title>Sykes Tax Calculator - Login</title>

        <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    </head>
    <body>
        <header>
            <div class="row bg-primary text-white"> 
                <div class="col-4">
                    Sykes Tax Calculator
                </div>
                <div class="col-4">
                    Login
                </div>
                <div class="col-4">
                </div>
            </div>
        </header>
        <section>
            <form action="LoginHandle.php" name="loginForm" method="post">
                <label>Username: </label>
                <input type="text" name="username">
                <br>
                <label>Password: </label>
                <input type="password" name="password">
                <br>
                <input type="submit">
            </form>
        </section>
    </body>
</html>