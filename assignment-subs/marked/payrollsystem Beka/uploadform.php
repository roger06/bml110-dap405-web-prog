<!-- Link header file -->
<?php
require('header.php');


$result = "";
if (isset($_FILES['file'])) {
   $errors = array();
   $file_name = $_FILES['file']['name'];
   $file_size = $_FILES['file']['size'];
   $file_tmp = $_FILES['file']['tmp_name'];
   $file_type = $_FILES['file']['type'];
   $tmp = explode('.', $file_name);
   $file_ext = end($tmp);

   $extensions = array("json");

   // Statements for result of file submitted
   if (in_array($file_ext, $extensions) === false) {
      $result = "File extension not allowed, please choose a JSON file.";
   } else if (empty($errors) == true) {
      move_uploaded_file($file_tmp, "uploads/" . $file_name);
      $result = "Success";
   } else {
      $result = "Upload failed";
   }
}
echo "<p id=\"upload_result\">$result</p>";
?>

<br>

<!-- Start of form code to upload and browser for file -->
<div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
   <h3>Upload a file</h3>

   <p>You can add files to the system for review by an administrator.
      Click <b>Browse</b> to select the file you'd like to upload,
      and then click <b>Upload</b>.</p>

   <form action="" method="POST" enctype="multipart/form-data">

      <input type="file" name="file" \>
      <input type="submit" value="Upload" \>

   </form>
</div>
<!-- End of form code to upload and browser for file -->

<!-- Link footer file -->
<?php
require('footer.php');
?>