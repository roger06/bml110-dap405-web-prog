
<html>


<head>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <title>Profile Upload</title>

    <link rel="stylesheet" type="text/css" href="style.css" />

    <script src="https://kit.fontawesome.com/b4f81ea84e.js" crossorigin="anonymous"></script>

</head>
<body>
<?php
session_start();

if (!isset($_SESSION['login_complete']) || $_SESSION['login_complete'] == false){
    header("Location: index.php");
}

$login_account = $_SESSION['login_account'];
$login_photo = $login_account . ".png";

?>


<header>
<?php 

include('header.php');
?>
    </header>

    <main class="container">
        <div class="row">
            <div class="col-12">
                <!-- https://www.w3schools.com/w3css/w3css_navigation.asp w3schools was used for research for the navbar strucutre-->
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="index.php">Menu</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="table.php">Home</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="profile_upload.php">Upload Picture<span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="tax_tables.php">Tax Tables</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">Logout</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

        </div>
</main>



<main class="container">
        <div class="row">
            <div class="col-12">
            <?php uploading_photo();
                ?>
            
                </div> 
                </div>
</main>

<?php






function uploading_photo(){
$login_account = $_SESSION['login_account'];
$login_photo = $login_account . ".png";

if (isset($_POST['submit'])){
   
   $photo_file = $_FILES['file'];//gets meta data from the file to do validaiton 
   
   $photo_file_name = $_FILES['file']['name'];
   $photo_file_tmp_name = $_FILES['file']['tmp_name'];
   $photo_file_size = $_FILES['file']['size'];
   $photo_file_error = $_FILES['file']['error'];
   $photo_file_type = $_FILES['file']['type'];
   $return_page = "profile_upload.php";

$photo_file_ext_name = explode('.',$photo_file_name);//gets the file extension. seperates name atthe '.'
$photo_file_ext = strtolower(end($photo_file_ext_name));//gets the end part of the name from the seperation 

$allowed_ext = array('png','jpg','jpeg');//only allows image types


if(in_array($photo_file_ext, $allowed_ext)){

    if($photo_file_error === 0){
        if($photo_file_size < 1000000){//checks for file size, files too big will get denied
            $photo_upload_name = $login_account.".".$photo_file_ext;//creates name
            $file_destination = 'photos/'. $photo_upload_name;//uploads photo to the folder
            move_uploaded_file($photo_file_tmp_name,$file_destination);
            header("Location: table.php?uploadsuccess");//Adding a popup to tell them it worked would be good, chrome cache memory does not always show it instantly. 
            
        }
        else{
            echo"Photo upload failed, file size too big";
            echo "<br>";
            echo"<a href='".$return_page."'>Go back</a>";
        }
    }
    else{
        echo"Photo upload failed, there was an error";
        echo "<br>";
        echo"<a href='".$return_page."'>Go back</a>";
    }


}
else{
    echo"Photo upload failed, invalid file type.";
    echo "<br>";
    echo"<a href='".$return_page."'>Go back</a>";

}

}
}
?>

</body>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
        crossorigin="anonymous"></script>



<footer>
<?php
include('footer.php');
?>

</footer>

    </body>
</html>
