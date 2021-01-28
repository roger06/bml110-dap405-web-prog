<?php
ini_set('display_errors', '0');//Don't display php errors.
session_start();
require "getJson.php";
require "auth.php";
require "layout.php";
require "tax_calculator.php";?>
<link rel="stylesheet" href="css/employee_style.css">
    <main>
<?php
if($currentClearance <2){ header("location: process.php"); }//Ensure user has clearance to delete acounts.
if(!isset($_POST["id"]) || $_POST["id"]==""){ header("location: error404.php");}//Otherwise redirect home.

//Finds the user relating to the POSTed id.
foreach($employee_data_array as $temployee){
    if($temployee["id"]==$_POST["id"]){
        $employee = $temployee;
    }   
}

//If a user isn't found this will redirect to error page.
if (!isset($employee)){ header("location: error404.php");}
$_SESSION["idToDelete"] = $_POST["id"];

//Display an overview of the employees profile so the user can ensure they are deleting the right account.
function AccountDiv($employee){
    $accountString = "<div id='employeeaccount'>";
    $accountString .= "<h2>".$employee["firstname"]." ".$employee["lastname"]."</h2>";
    $accountString .= "<img src='profile_photos/".$employee["photo"]."' alt='employee profile photo' id='mainphoto'/>";
    $accountString .= "<table><tr><td>Employee:</td><td class='tableinfo'>".$employee["id"]."</td></tr>";
    $accountString .= "<tr><td>Department:</td><td class='tableinfo'>".$employee["department"]."</td></tr>";
    $accountString .= "<tr><td>Role:</td><td class='tableinfo'>".$employee["jobtitle"]."</td></tr>";
    $accountString .= "<tr><td>Email:</td><td class='tableinfo'>".$employee["email"]."</td></tr>";

    $address = implode(",<br>", explode(", ", $employee["homeaddress"]));
    $accountString .= "<tr><td>Phone:</td><td class='tableinfo'>".$employee["phone"]."</td></tr>";
    $accountString .= "<tr><td>Address:</td><td class='tableinfo'>".$address."</td></tr>";

    //Only adds the 'otherroles' row to the table if the person has 'otherroles'.
    if(!empty($employee["otherroles"])){
        $accountString .= "<tr><td>Other Roles: </td>";
        $accountString .= "<td class='roleicons' colspan='2'>";
        foreach(array_keys($_SESSION["icons"]) as $icon)
        {
            if(in_array($icon, $employee["otherroles"])){
                $accountString .= $_SESSION["icons"][$icon]." ";
            }
        }
        $accountString.="</td></tr>";
    }
    $accountString .= "</table></div>";

    return $accountString;
}

//Gives the user one last chance to ensure they want to delete the account. Defaults to NO!
function DeleteCheck($employee){
    $deleteString = "<div id='delete'>";
    
    if ($_SESSION["user"]["id"]==$_POST["id"]){ $deleteString .= "<h2>Error: You cannot delete yourself from the system. </h2></div>";}
    else{
        $deleteString .=  "<h2>ARE YOU SURE YOU WANT TO DELETE THIS EMPLOYEE'S ACCOUNT?</h2>";

        $deleteString .= "<form action='deleted.php' method='POST' id='checkdelete'>";
        $deleteString .= '<input type="radio" id="no" name="delete" value=0 checked>
        <label for="no">NO</label><br>
        <input type="radio" id="yes" name="delete" value=1>
        <label for="yes">YES</label><br>';
        $deleteString .= "<input type='submit'>";
        $deleteString .= "</form></div>";
    }
    
    return $deleteString;
}

//Echo out strings to html.
echo AccountDiv($employee);
echo DeleteCheck($employee);
?>
            </div>
        </main>
    </body>
</html>