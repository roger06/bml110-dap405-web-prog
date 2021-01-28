<!doctype html>
<html lang="en">

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
                
            <h2>Profile Picture Upload</h2>
            <p>Keep pictures below 10mb.</p>


<form action="upload.php" method="POST" enctype="multipart/form-data"> <!--allows multiple file types to be uploaded-->
<input type="file" name="file">
<button type="submit" name="submit">Upload</button>
</form>
                </div>
</div>
</main>


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
