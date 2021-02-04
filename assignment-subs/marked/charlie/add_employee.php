<?php
################################################################################
#This is the file that attempts to format the users entry of employee data     #
#this file will also display varying success messages relating to image upload.#
################################################################################ 


ini_set('display_errors', '0');//Prevents Php error being displayed.
session_start();
require "getJson.php";
require "auth.php";
require "layout.php";?>

<link rel="stylesheet" href="css/simple.css">
<div>
<?php
$usedIds = array();
foreach($employee_data_array as $employee){
    array_push($usedIds, $employee["id"]); //Creates array of all user ids.
}
$newId = max($usedIds)+1; //Auto increments a new, unique ID.

$imageFileType = strtolower(pathinfo($_FILES["photo"]["name"],PATHINFO_EXTENSION));
$target_file = "profile_photos/".$newId.".".$imageFileType;
require "check_image.php";//Call to a php file that validates the image upload.

//The following 3 explode csv entries to arrays (for storing as json).
$_POST["reports"] = explode(",", $_POST["reports"]);
$_POST["previousroles"] = explode(",", $_POST["previousroles"]);
$_POST["otherroles"] = explode(",", $_POST["otherroles"]);

//The following converts the boolean values to their appropriate counterparts.
if ($_POST["pension"] = "on"){$_POST["pension"] = "y";}
else {$_POST["pension"] = "n"; }
if ($_POST["pensiontype"] = "on"){$_POST["pensiontype"] = "final";}
else {$_POST["pensiontype"] = ""; }
if ($_POST["companycar"] = "on"){$_POST["companycar"] = "y";}
else {$_POST["companycar"] = "n"; }

//This initialises a new employee array where the new employee's data can be collated so that it can be added to the existing array/json.
$new_employee_data = ["id"=>$newId];

if(isset($_POST["firstname"])){
    foreach($_POST as $key=>$value){
        $new_employee_data[$key] = $value;

        //Since the 'photo' value is posted as a file, a link for the photo must be generated from concatenating the user id and filetype
        //then inserted into the just after national insurance (to remain consistent with the original json).
        if ($key == "nationalinsurance") {
            $new_employee_data["photo"] = $newId.".".$imageFileType;
        }
    }
}
array_push($employee_data_array, $new_employee_data);//Adds the new employee to the array.

$employee_file = "json_files/employees-final.json";
$new_json = json_encode($employee_data_array, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);//Encodes and formats json appropriately.
file_put_contents($employee_file, $new_json);//Overwrites original file.
?>
<h2>Employee Added</h2>
</div>
</body>
</main>