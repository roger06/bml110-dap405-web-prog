<?php

/*
    1 check file type.
    2 rename file
    3. check if file alreay exists (and rename if it does)
    4. check file is an image
    5. check image dimensions
    6. display image.
*/
    echo '<pre>';
    print_r($_FILES);
    echo '</pre>';

$username = 'rholden';

$uploads = 'uploads/';

$file = $_FILES['myfile']['tmp_name'];
$filename  = $_FILES['myfile']['name'];


// check file is jpg

if (  $_FILES['myfile']['type'] !=  'image/jpeg' ) {

    echo 'please upload jpg';
    exit;
}

// get image dimenions.

$imgdims = getimagesize($file);

 
 if ( $imgdims[0] > 4000 ) {

    echo '<p>image too wide!</p>';
    die();

 }

echo '<pre>';
print_r($imgdims);
echo '</pre>';

 

$filename = 'bob.jpg';

// $filename = $username.time() . '.jpg';

// check if file already exists and if so rename

if ( file_exists( $uploads.$filename)   ) {

    echo 'file exists';
    $filename = $username.time() . '.jpg';
   
}


if (move_uploaded_file($file, $uploads.$filename )) {

    // file upload successful

    echo '<p>file upload successful</p>';
    echo  '<p>Original name = '.$_FILES['myfile']['name'].'    Uploaded name =  '.$filename.' </p>';

}

else {

    echo 'file upload failed.';
}

 
?>

<!-- <img src="<?php echo $uploads.$filename;?>" alt="" <?php echo $imgdims[3];?>> -->
<img src="<?php echo $uploads.$filename;?>" alt="" width="400">