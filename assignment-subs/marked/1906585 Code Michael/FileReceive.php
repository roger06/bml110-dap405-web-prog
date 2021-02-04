<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .Container{
            width: 80%;
            margin: auto;
            text-align: center;
        }
    </style>
</head>
<body>
    <form id="form1" method="POST">
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

            if (!isset($_FILES["UploadFile"])){//Checks if a file has been selected
                echo "<br><br>Sorry, No file is selected.<br><br><br><br>";
                echo "<a type='button' class='btn btn-outline-danger' href='ViewAccount.php' >Return To Account Page</a>";
                die();
            }

            $Directory = "Uploads/";
            $Check = $_FILES["UploadFile"]["name"];
            $Extension = $_FILES["UploadFile"]["type"];
            $Size = $_FILES["UploadFile"]["size"];
            if (!file_exists($Directory.$Check)){ //Checks if the file already exists with the same name
                if ($Extension == "image/png" or $Extension == "image/jpg" or $Extension == "image/jpeg"){//Checks the file is a valid image type
                    if ($Size <= 4000000){//Checks the file is less thatn 4mb
                        if (move_uploaded_file($_FILES["UploadFile"]["tmp_name"], $Directory.$Check)){
                                echo "<br><br>Your new Profile image has been uploaded. Please contact a site admin
                                         to make amendments and set this as your default image.<br><br><br><br>";
                                echo "<a type='button' class='btn btn-outline-danger' href='ViewAccount.php' >Return To Account Page</a>";
                        } else {
                            echo "<br><br>Sorry this file has not successfully uploaded.<br><br><br><br>";
                            echo "<a type='button' class='btn btn-outline-danger' href='ViewAccount.php' >Return To Account Page</a>";
                        }
                    } else {
                        echo "<br><br>Sorry this file is to large, Please compress it and try again.<br><br><br><br>";
                        echo "<a type='button' class='btn btn-outline-danger' href='ViewAccount.php' >Return To Account Page</a>";
                    }
                } else {
                    echo "<br><br>Sorry this file is not in the correct format, Please try again.<br><br><br><br>";
                    echo "<a type='button' class='btn btn-outline-danger' href='ViewAccount.php' >Return To Account Page</a>";
                }
            } else{
                echo "<br><br>Sorry There is already a file with this name saved on the server. Please rename and try again.<br><br><br><br>";
                echo "<a type='button' class='btn btn-outline-danger' href='ViewAccount.php' >Return To Account Page</a>";
            }
            //if ($)
            //path
        ?>
        </div>
    </form>
</body>
</html>