<?php
################################################################################
#This file echos varying success messages relating to image upload.            #
#TAKEN FROM: https://www.w3schools.com/php/php_file_upload.asp                 #
################################################################################ 


$uploadOk = 1;
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["photo"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "<h2>File is not an image.</h2>";
    $uploadOk = 0;
  }
}

// Check file size
if ($_FILES["photo"]["size"] > 50000000) {
  echo "<h2>Sorry, your file is too large. Files should not be bigger than 5MB</h2>";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "<h2>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</h2>";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "<h2>Sorry, your file was not uploaded.</h2>";
// if everything is ok, try to upload file
} 
else {
  if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
    echo "<h2>The file ". htmlspecialchars( basename( $_FILES["photo"]["name"])). " has been uploaded.</h2>";
    //The JSON must also be UPDATED with a unique file name based on the users ID
    // because some employees share the same photo name.
    foreach ($employee_data_array as $key => $employee){
      if($employee["id"] == $_SESSION["user"]["id"]){
      $employee["photo"] = $_SESSION["user"]["id"].".".$imageFileType;
      $employee_data_array[$key] = $employee;
  }
}
  } else {
    echo "<h2>Sorry, there was an error uploading your file.</h2>";
  }
}
?>