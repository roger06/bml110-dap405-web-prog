<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style type="text/css">
        body {
            /* text-align: center; */
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            background-color: whitesmoke;
            color: #313639;
        }

        .btn1 {
            color: whitesmoke;
            border-radius: 10%;
            background-color: #808080;
        }

        .btn1:hover {
            background-color: #BEBEBE;
        }

        .container{
            min-height: 100%;
            text-align: center;
        }

        .btn-success{
            border-color: black !important;
        }
    </style>
</head>

<body>
    <div class="container">
        
        <form id="form1" action="homePage.php" method="POST">
            <?php
            if (!isset($_SESSION)){
                Session_start();
                try{
                    //Destroys all Session Variables
                    Session_destroy();
                } catch (Exception $Ex){
                }
            }                
            ?>
            
            <h2>Welcome</h2>
            <br>
            Username: <input type="text" name="txtUserName" />
            <br>
            Password: <input type="password" name="txtPassword" />
            <br>
            <br>
            <button type="submit" class="btn btn-success">Login</button>
            <br><br>(Username is User1 and Password is Password1)
        </form>
    </div>
</body>

</html>