<?php
#############################################################################################
#This file is not displayed but generates a table string in html to display employees data. #
#############################################################################################

require "tax_calculator.php";

function DesignTable($employee_data_array, $stylings, $clearance=0){
    //Only show salary and after tax if high enough clearance.
    if ($clearance >= 1){
        $htmlString = "<table>
        <tr class='tablehead'>
        <th> </th><!--Profile Photo -->
        <th>ID</th>
        <th>Name</th>
        <th>Salary</th>
        <th>Monthly Net</th>
        <th>More</th>
        </tr>";
    }
    //Otherwise pad the table with other helpful information.
    else {
        $htmlString = "<table>
        <tr class='tablehead'>
        <th> </th><!--Profile Photo -->
        <th>ID</th>
        <th>Name</th>
        <th id='roleheader'>Roles </th>
        <th>More</th>
        </tr>";
    }
    $rowCount = 0;
    foreach($employee_data_array as $employee){
        $rowCount += 1;//Row Count passed in to style odd and even rows differently
        
        //Create a Row for thsi Employee.
        $htmlString .= FormatRow($employee, $stylings, $rowCount, $clearance);
    }
    $htmlString .= "</table>";

    return $htmlString;
}

//Used to see if a row is even for styling
function IsEven($num){
    if($num%2 == 0){return true;}
    else{return false;}
}

function FormatRow($employee, $stylings, $rowCount, $clearance=0){
    //by alternating the row even and odd they can be assigned different CSS Classes for background colour.
    if ($stylings["alternate"] == true and IsEven($rowCount)){
        $rowString = "<tr class='alternate'>";
    }
    else{
        $rowString = "<tr>";
    }

    //Call out to functions to assemble/concatenate the rowstring.
    $rowString .= GetImage($employee);
    $rowString .= FormatID($employee);
    $rowString .= FormatName($employee, $stylings);

    //Those with high clearance see salaries
    if($clearance >= 1){
        $rowString .= FormatSalary($employee, $stylings);
        $rowString .= FormatAfterTax($employee, $stylings);
    }
    //low clearance just see otherroles icons.
    else{
        $rowString .= GetOtherRoles($employee);
    }
    $rowString .= GetButton($employee);
    $rowString .= "</tr>";

    return $rowString;
}

//This was a feature i never had time to implement but would've loved to. 
//it just changes the way names are assembled based on the values in the stylings array.
function FormatName($employee, $stylings){
    $nameString = "<td class='employeename'>";
    
    if ($stylings["name"] == 0){
        $nameString .= $employee["firstname"]." ".$employee["lastname"];
    }
    elseif ($stylings["name"] == 1){
        $nameString .= $employee["firstname"][0].".".$employee["lastname"];
    }
    elseif ($stylings["name"] == 2){
        $nameString .= $employee["lastname"].", ".$employee["firstname"];
    }
    else{
        $nameString .= $employee["firstname"]." ".$employee["lastname"];
    }
    
    $nameString .= "</td>";

    return $nameString;
}

//Displays the employee's otherroles as font awesome icons and has a hover feature for more info.
function GetOtherRoles($employee){
    $iconString = "<td class='roleicon'>";

    //The icon data is got from a JSON file other-role-icons.json
    foreach(array_keys($_SESSION["icons"]) as $icon)
    {
        if(in_array($icon, $employee["otherroles"])){
            $iconString .= $_SESSION["icons"][$icon]." ";
        }
    }
    $iconString.="</td>";

    return $iconString;
}

//Get the employee's profile photo
function GetImage($employee){
    $photoString = "<td class='tablephoto'>";
    $photoString .= "<img src='profile_photos/".$employee["photo"]."' alt='employee profile photo' width=50 />";
    $photoString .= "</td>";

    return $photoString;
}

function FormatID($employee){
    $photoString = "<td class='numeric id'>";
    $photoString .= $employee["id"];
    $photoString .= "</td>";

    return $photoString;
}

function FormatSalary($employee, $stylings){
    $CURRENCY_SYMBOLS = array("GBP" => "£", "USD" => "$", "EUR" => "€", "JPY" => "¥");

    $salaryString = "<td class='numeric'>";
    if($stylings["includecurrency"] == true){
        $salaryString .= "(".$employee["currency"].")";
    }
    $salaryString .= $CURRENCY_SYMBOLS[$employee["currency"]];
    $salaryString .= number_format($employee["salary"], 2, ".", ",");
    
    
    $salaryString .= "</td>";
    
    return $salaryString;
}

function FormatAfterTax($employee, $stylings){
    $salaryString = "<td class='numeric'>";

    //only if it's GBP will it be taxed, any other currency will assume tax is paid abroad.
    if($employee["currency"] == "GBP"){
        $salaryString .= "£".number_format(CalculateAfterTax($employee)/12, 2, ".", ",");
    }
    else{$salaryString .= "N/A";}
    
    $salaryString .= "</td>";
    
    return $salaryString;
}

//Generates a button that takes you to the Employees custom page.
function GetButton($employee){
    $buttonString ="<td class='seymorebutt'>";
    // $buttonString .= "<a href='/Assignment/employee.php?id=".$employee["id"]."'>";

    // changed by RH to get it to work
    $buttonString .= "<a href='employee.php?id=".$employee["id"]."'>";

    
    $buttonString .="<i class='fas fa-search-plus'></i>";
    $buttonString .="</a>";
    $buttonString .="</td>";

    return $buttonString;
}
?>
