<!-- Standard Header that's called on most pages to display navbar and stylings.-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="Description" CONTENT="Pay records of ACME employees.">

        <title>ACME | Payroll</title>
        <link href="https://fonts.googleapis.com/css2?family=Anton&family=Lobster&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/b12863e982.js" crossorigin="anonymous"></script>
        
        <link rel="stylesheet" href="css/layout_style.css"/>

    </head>
    <body>
    <div class="header">
        <h1 id="logo"><a href="process.php">ACME Pay</a></h1>

        <section class="flextainer">
            <ul class="menu">
                <!-- <li><a href="<?php echo "employee.php?id=".$_SESSION["user"]["id"]?>">Account</a></li> -->
                <li><a href="fpdf/payslip.php" target="_blank">Payslip</a></li>
                <?php
                if ($currentClearance >= 2){
                    echo("<li><a href='manage.php'>Manage</a></li>");
                }
                ?>
                <li><a href="logout.php">Logout</a></li>
                <li><a href="<?php echo "employee.php?id=".$_SESSION["user"]["id"]?>"><img id="navbarphoto" src='profile_photos/<?php echo $_SESSION["user"]["photo"]?>' alt="personal profile photo"></a></li>   
            </ul>
        </section>
    </div>