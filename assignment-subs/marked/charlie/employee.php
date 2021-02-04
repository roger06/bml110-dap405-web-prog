<?php
ini_set('display_errors', '0');
session_start();
require "getJson.php";
require "auth.php";
require "layout.php";
require "tax_calculator.php";?>
<link rel="stylesheet" href="css/employee_style.css">
    <main>
<?php

//Ensures values are passed in or the user is redirected.
if(!isset($_GET["id"]) || $_GET["id"]==""){ header("location: error404.php");}

//Finds the Users information.
foreach($employee_data_array as $temployee){
    if($temployee["id"]==$_GET["id"]){
        $employee = $temployee;
    }  
}

//Generatesa string that is html that displays user info and can be echoed out. 
function AccountDiv($employee, $clearance){
    $accountString = "<div id='employeeaccount'>";
    $accountString .= "<h2>".$employee["firstname"]." ".$employee["lastname"]."</h2>";
    $accountString .= "<img src='profile_photos/".$employee["photo"]."' alt='employee profile photo' id='mainphoto'/>";

    //Allows people to change their own user photo.
    if ($_SESSION["user"]["id"]==$employee["id"]){
        $accountString .= "<form action='update_photo.php' method='POST' name='updatephoto' enctype='multipart/form-data' >";
        $accountString .= "<label for='photo'>Update Photo: </label><input type='file' name='photo'>";
        $accountString .= "<input type='submit' value='update' required/></form>";
    }

    //0 clearance level info.
    $accountString .= "<table><tr><td>Employee:</td><td class='tableinfo'>".$employee["id"]."</td></tr>";
    $accountString .= "<tr><td>Department:</td><td class='tableinfo'>".$employee["department"]."</td></tr>";
    $accountString .= "<tr><td>Role:</td><td class='tableinfo'>".$employee["jobtitle"]."</td></tr>";
    $accountString .= "<tr><td>Email:</td><td class='tableinfo'>".$employee["email"]."</td></tr>";

    //Greater than 1 clearance (phone and address).
    if($clearance >= 1 || $_SESSION["user"]["id"] == $employee["id"]){
        $address = implode(",<br>", explode(", ", $employee["homeaddress"]));//replace commas in address with newline characters.
        $accountString .= "<tr><td>Phone:</td><td class='tableinfo'>".$employee["phone"]."</td></tr>";
        $accountString .= "<tr><td>Address:</td><td class='tableinfo'>".$address."</td></tr>";
    }

    //Only displays the users 'otherroles' if they have 'otherroles'
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

//This function Shows summaries of tax paid and a breakdown of the brackets.
//all the tax calculations are called out to tax_calculator.php.
function DisplayTax($employee, $clearance){
    //Some users can only see their own salary, those with higher clearance can see everyones.
    if ($clearance >= 1 || $employee["id"] == $_SESSION["user"]["id"]){
        $CURRENCY_SYMBOLS = array("GBP" => "£", "USD" => "$", "EUR" => "€", "JPY" => "¥");//Abbreviations are keys since some currencies share symbols but not abbreiviations.
        $symbol = $CURRENCY_SYMBOLS[$employee["currency"]];//Gets the current users currency.


        $completeBrackets = CalculateAndGetBrackets($employee);
        $count = 1;
        
        $taxString = "<div id='breakdown'> <h2>Salary Summary</h2>";
        
        //Annual breakdown of salary, tax, and take home.
        $taxString .= "<h3>Annual Breakdown:</h3>";
        $taxString .= "<table id='toptable'><tr><td>Annual Salary:</td><td class='numeric'>".$symbol.number_format($employee["salary"], 2)."</td></tr>";
        $taxString .= "<tr><td>Annual Tax:</td><td class='numeric'>".$symbol.number_format(CalculateTaxTotal($employee), 2)."</td></tr>";
        $taxString .= "<tr><td>Annual Take Home:</td><td class='numeric'>".$symbol.number_format(CalculateAfterTax($employee), 2)."</td></tr></table>";
        
        //Monthly breakdown of salary, tax, and take home.
        $taxString .= "<h3>Monthly Breakdown:</h3>";
        $taxString .= "<table><tr><td>Monthly Salary:</td><td class='numeric'>".$symbol.number_format($employee["salary"]/12, 2)."</td></tr>";
        $taxString .= "<tr><td>Monthly Tax:</td><td class='numeric'>".$symbol.number_format(CalculateMonthlyTax($employee), 2)."</td></tr>";
        $taxString .= "<tr><td>Monthly Take Home:</td><td class='numeric'>".$symbol.number_format(CalculateMonthlyTakeHome($employee), 2)."</td></tr></table>";
        
        //Breakdown of annual tax-brackets. anyone with a company car or earning over £150k has their tax-free allowance halved.
        $taxString .= "<h3>Bracket Breakdown:</h3>";
        if($employee["companycar"] == "y"){ $taxString .= "<table><tr><td>Company Car: TRUE</td></td></table>";}
        if($employee["salary"]>150000){ $taxString .= "<table><tr><td>Earns over £150,000: TRUE</td></td></table>";}
        $taxString .= "<table>";    
        foreach($completeBrackets as $bracket){
            $taxString .= "<tr><td>".$symbol.number_format($bracket["min"], 0)."-".$symbol.number_format($bracket["max"], 0)."</td>";
            $taxString .="<td class='numeric'>".$symbol.number_format($bracket["paid"], 2)."</td></tr>";
        }

        $taxString .= "</table>";
    }
    else{
        $taxString = "";
    }
        return $taxString;
    }

echo AccountDiv($employee, $currentClearance);
echo DisplayTax($employee, $currentClearance);
?>
            </div>
        </main>
    </body>
</html>