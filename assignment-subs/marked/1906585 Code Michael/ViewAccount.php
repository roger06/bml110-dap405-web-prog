<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        .Container{
            width: 80%;
            margin: auto;
            text-align: center;
        }
        .ImageHeader{
            width: 35%;
            margin: auto;
        }
    </style>
</head>
<body>
    <?php
        require_once('Menu.php');
        ?>
    <form id="form1" method="POST" enctype="multipart/form-data" action="FileReceive.php">
    <div class="Container">
        <?php
            if(!isset($_SESSION)){
                session_start();
            }
            if (!isset($_SESSION['Login'])) {
                echo "<br><br>Sorry the session has expired.<br><br><br><br>";
                echo "<a type='button' class='btn btn-outline-danger' href='login.php' >Return To Login Page</a>";
                die();
            }
            require_once('Functions.php');
        ?>
        <div class="ImageHeader">
            <br>
            <h3 class="h3 display-4">
                User Profile
            </h3>
            <br>
            <img src="Blank_Profile_1.png" class="img-thumbnail rounded-circle" alt="unable to upload get photo">
            <br>
            <br>
            <input type="file" name="UploadFile" value="Select File"><!--Allows files to be uplaoded-->
            <p>Note: Please make sure the image is below 4Mb!</p>
        </div>

        <input type="submit" name="btnUpFile" class="btn btn-success">
    </div>
    </form>
</body>
</html>