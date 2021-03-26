<?php
    echo '<pre>';
      print_r($_FILES);
    echo '</pre>';

$username = 'rholden';    

$uploads = 'uploads/';

$filename = $_FILES['myfile']['name'];   // just the name of the file (which we can change)

$file = $_FILES['myfile']['tmp_name'];  // the temp location of the file


$imagedetails = getimagesize($file);


echo '<pre>';
print_r($imagedetails);
echo '</pre>';

// don't allow images wider than 1500px.

// if (  $imagedetails[0] > 2500  ) {
//     echo 'too big';
//     exit;

// }

   

// echo $filename;

// now move file to uploads folder.
// change the filename

$filename = 'bob1.jpg';
// $filename = $username.time(). '.jpg';


// 1. make unique *
// 2. check if file exists before uploading.

//  if ( file_exists($uploads.$filename)  ) {

//     // halt
//     // rename
//     echo 'file already exists!!';

//     $filename = $filename.'1';


//  }

//  else echo 'file name is indeed unique';


 


 if ( @move_uploaded_file($file,$uploads.$filename )  ) {

    // if a sucess
    echo 'upload a success. File = ' . $filename ;
 }

 else {

    // upload fails.

    echo 'the upload has failed!';
 }
 
// display  image 

?>
    <img src="<?php echo $uploads.$filename;?>" alt="alt herer" width="400" >

<?php
  



?>