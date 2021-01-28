<!doctype html>
<html lang="en">

<head>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <title>Table Breakdown</title>

    <link rel="stylesheet" type="text/css" href="style.css" />

    <script src="https://kit.fontawesome.com/b4f81ea84e.js" crossorigin="anonymous"></script>

</head>


<?php


session_start();

if (!isset($_SESSION['login_complete']) || $_SESSION['login_complete'] == false){
    header("Location: index.php");//checks to see if the user is logged in. If they try and access this page/url without being logged in it will send them to index(log in page)
}

$login_account = $_SESSION['login_account'];
$login_photo = $login_account . ".png";//pre assigns png to the log in photo. This is due to them being imported as png. 
//echo $login_photo
?>

<body>
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
                            <li class="nav-item active">
                                <a class="nav-link" href="table.php">Home <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="profile_upload.php">Upload Picture</a>
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



<?php


function main_table(){

include 'tax_calc.php';
$login_account = $_SESSION['login_account'];

//Fetching JSON file content using php file_get_contents method
$str_data = file_get_contents("employees-final.json");
$data = json_decode($str_data, true);

if(!is_array($data)){
    throw new Exception('Could not decode the JSON');//looks for error
}

$jsonError = json_last_error();//gets data and assigns it to a variable 
if(is_null($data) && $jsonError == JSON_ERROR_NONE){//checks if array contains data
    throw new Exception('Could not decode JSON, file missing.');
}

if($jsonError != JSON_ERROR_NONE){
    $error = 'Could not decode JSON! ';
}

 
//Creates a temp variable that will have data appeneded to it
$temp = "<table>";
 
//Naming the columns heads and appendin them as columns to the temp variable
$temp .= "<tr><th>Photo</th>";
$temp .= "<th>ID Number</th>";
$temp .= "<th>First Name</th>";
$temp .= "<th>Last Name</th>";
$temp .= "<th>Job Title</th>";
$temp .= "<th>NI Number</th>";
$temp .= "<th>Company Car</th>";
$temp .= "<th>Monthly Net Pay</th>";
$temp .= "<th>Currency</th>";
$temp .= "<th>Pay Slip</th></tr>";

 
//creating of the data within the table

if ($login_account == "admin"){
//checks if logged in as admin. Admin can see all records whereas if they are logged in as an employye they can only see their own data.

for($i = 0; $i < sizeof($data); $i++)
{
if($data[$i]["companycar"]=="y"){//changes varible for company car to yes/no instead of y/n. 
$companycaroutput = "Yes";
} 
else{
    $companycaroutput = "No";
}

if($data[$i]["currency"]=="GBP"){//creates currency symbols dependent on curreny field
    $currencysymbol = "&pound;";//assigns to be asii format to prevent issues with formatting
    } 
elseif($data[$i]["currency"]=="USD"){
        $currencysymbol = "$";
        } 
        else{
            $currencysymbol = " ";//incase currency field is blank or a new currency it will be left blank
        }



$userid = $data[$i]["id"];
$link_address1 = "breakdown.php?userid=".$userid;//links to the breakdown page with the user id in the url

$salary = $data[$i]["salary"];  //create variables to run the function
$currency = $data[$i]["currency"];
$companycar = $data[$i]["companycar"];

$monthly_values = calc_tax($salary, $currency,$companycar); // gets data from function as an array
$monthly_salary_rounded = $monthly_values[0]; //breaks array down into individual variabls
$monthly_tax_rounded = $monthly_values[1];

$image = $data[$i]["photo"];


//actual creating of the data witin the table
$temp .= "<tr>";

$temp .= "<td>" . "<img src='photos/".$image."'>". "</td>";//output the profile picture as an image within the table
$temp .= "<td>" . $data[$i]["id"] . "</td>";
$temp .= "<td>" . $data[$i]["firstname"] . "</td>";
$temp .= "<td>" . $data[$i]["lastname"] . "</td>";
$temp .= "<td>" . $data[$i]["jobtitle"] . "</td>";
$temp .= "<td>" . $data[$i]["nationalinsurance"] . "</td>";
$temp .= "<td>" . $companycaroutput . "</td>";
$temp .= "<td>" . $currencysymbol . $monthly_salary_rounded . "</td>";
$temp .= "<td>" . $data[$i]["currency"] . "</td>";

$temp .= "<td>" . "<a href='".$link_address1."'>More" . "</td>";//outputlink to breakdown page


//https://stackoverflow.com/questions/11772493/how-to-pass-a-value-via-href-php
$temp .= "</tr>";
}
 
//table closed
$temp .= "</table>";
 
//outputting the temp varible that is holding the table 
echo $temp;


}


elseif ($login_account != "admin"){
  
for($i = 0; $i < sizeof($data); $i++)
{
if($data[$i]["id"] == $login_account){
     
if($data[$i]["companycar"]=="y"){
$companycaroutput = "Yes";
} 
else{
    $companycaroutput = "No";
}

if($data[$i]["currency"]=="GBP"){
    $currencysymbol = "£";
    } 
elseif($data[$i]["currency"]=="USD"){
        $currencysymbol = "$";
        } 
        else{
            $currencysymbol = " ";
        }



$userid = $data[$i]["id"];
$link_address1 = "breakdown.php?userid=".$userid;

$salary = $data[$i]["salary"];  
$currency = $data[$i]["currency"];
$companycar = $data[$i]["companycar"];

$monthly_values = calc_tax($salary, $currency,$companycar); // gets data from function as an array
$monthly_salary_rounded = $monthly_values[0]; //breaks array down into individual variabls
$monthly_tax_rounded = $monthly_values[1];


$image = $data[$i]["photo"];
$temp .= "<tr>";
$temp .= "<td>" . "<img src='photos/".$image."'>". "</td>";
$temp .= "<td>" . $data[$i]["id"] . "</td>";
$temp .= "<td>" . $data[$i]["firstname"] . "</td>";
$temp .= "<td>" . $data[$i]["lastname"] . "</td>";
$temp .= "<td>" . $data[$i]["jobtitle"] . "</td>";
$temp .= "<td>" . $data[$i]["nationalinsurance"] . "</td>";
$temp .= "<td>" . $companycaroutput . "</td>";
$temp .= "<td>" . $currencysymbol . $monthly_salary_rounded . "</td>";
$temp .= "<td>" . $data[$i]["currency"] . "</td>";



$temp .= "<td>" . "<a href='".$link_address1."'>More" . "</td>";

$temp .= "</tr>";
}
}


$temp .= "</table>";
 
echo $temp;  
} 
}

?>


<main class="container"> 

<div class="row">
            <div class="col-12">
                
                <?php main_table();//actual part that outputs the table
                ?>
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



