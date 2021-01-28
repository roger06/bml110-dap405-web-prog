<?php
ini_set('display_errors', '0');//Don't display php errors.
session_start();
require "getJson.php";
require "auth.php";
require "layout.php";?>

<link rel="stylesheet" href="css/simple.css">
<div>
<?php
//Failsafe, if delete command is unclear or unset, the account will not delete.
if (!isset($_POST["delete"])
    || !isset($_SESSION["idToDelete"])
    || ($_POST["delete"] != 0 && $_POST["delete"] !=1)
    || $_POST["delete"] == 0){
         echo "<h2>Employee account not deleted</h2>";
}

//Deletes the account from the array, and then re-encodes and overwrites the json.
elseif($_POST["delete"] == 1) {
    $deleteCount = 0;

    foreach($employee_data_array as $key=>$employee){
        if ($employee["id"] == $_SESSION["idToDelete"]){
            $photoAddress = "profile_photos/".$employee["photo"];
            unset($employee_data_array[$key]);
            $deleteCount += 1;
        }
    }
    if ($deleteCount>0){
        unlink($photoAddress);//Delete profile photo.
        $employee_file = "json_files/employees-final.json";
        $new_json = json_encode($employee_data_array, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        file_put_contents($employee_file, $new_json);//Overwrite Json.
    
        unset($_SESSION["idToDelete"]);//Remove this id so that it does not get deleted twice by mistake.
        echo "<h2>Account Successfully Deleted</h2>";
    }
    else{
        echo "<h2>Error: Employee not deleted.</h2>";
    }
}
?>
</div>
</body>
</main>