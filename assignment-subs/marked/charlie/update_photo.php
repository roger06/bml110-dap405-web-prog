<?php
session_start();
require "getJson.php";
require "auth.php";
require "layout.php";
?>
<link rel="stylesheet" href="css/simple.css">
<div>
<?php

$imageFileType = strtolower(pathinfo($_FILES["photo"]["name"],PATHINFO_EXTENSION));
$target_file = "profile_photos/".$_SESSION["user"]["id"].".".$imageFileType;
require "check_image.php";

//Update and overwrite the JSON.
$employee_file = "json_files/employees-final.json";
$new_json = json_encode($employee_data_array, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
file_put_contents($employee_file, $new_json);
?>
</div>
</body>