<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$uploads ='uploads/';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>file uploads - step one. </title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <style type="text/css">
        body {
            padding-top: 0.5rem;
        }

        .starter-template {
            padding: 3rem 1.5rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <main role="main" class="container">
        <div class="starter-template">
            <h1>File uploads</h1>
        </div>


        <?php

        if (isset($_POST['submit']) ) {
            
                
            $resize = $_POST['resize'];
//            
//            echo "reszie value = " .$resize;
//            exit;
            echo '<h3>Form submitted</h3>';
            echo '<h4>When you submit a file, you get a $_FILES array as well as $_POST</h4>';
            echo '<p>This contains name (file name), the type, where it is stored temporarily, errors, file size</p>';
            echo '<p>We could, therefore, reject it at this stage if it is too big or the wrong type.</p>';



            echo '<h4>File type</h4>';
            echo $_FILES['myfile']['type'];

            echo '<h4>File size</h4>';
            echo $_FILES['myfile']['size'] .' bytes';

            $filename =  $_FILES['myfile']['name'] ;


            if ( move_uploaded_file( $_FILES['myfile']['tmp_name'], $uploads.$filename        )) echo '<p>file uploaded</p>';
            else echo '<p>upload failed</p>';

//            if it's an image - let's display it

            if (file_exists($uploads.$filename)  && (exif_imagetype($uploads.$filename)  == IMAGETYPE_JPEG  || exif_imagetype($uploads.$filename)  == IMAGETYPE_PNG   ))    {
                
                // get size getimagesize returns an array
                
                $size = getimagesize($uploads.$filename);
                
                echo "Image dimentions are " . $size[0] ." by " .$size[1];
                echo '<img src="'.$uploads.$filename.'">';

            }

                       
            $orig =  $uploads.$filename;
             
            if (!$resource = imagecreatefromjpeg($orig)) {
                
                echo "failed to create rsource";
                exit();
            } 
            
//            else {
//                
//                echo "<p>file created from jpeg - ".$resource."</p>";
//            }
  
             if (!$imageResized = imagescale($resource, $resize)) {
               echo "failed to resize img to " . $resize;
               exit();
             } 
            
          
//              else {
//                
//                echo "<p>file resized jpeg - ".$imageResized."</p>";
//            }
            
            $new_name = time().".png";
            $new_name = time().".jpg";
            
            $write = imagepng($imageResized, 'uploads/'.$new_name);
            $write = imagejpeg($imageResized, 'uploads/'.$new_name);
 
          
            echo '<h2>Resized to '.$resize.'</h2>';
            
            echo '<img src="'.$uploads.$new_name.'">';
 

        } // end if form is submitted


        else {  ?>


        <h1>Upload a file and do something with it</h1>
        <p>We must do some error checking as:</p>
        <ul>
            <li>We don't want certain file types, .exe .bat .dll etc</li>
            <li>We don't files over a certain size</li>
            <li>If we want an image (for example) then we need to check one's been uploaded</li>
        </ul>
        <h4>Generally, once we've error checked the upload we want to:</h4>


        <ul>
            <li>Move it to a particular location - this MUST have write access</li>
            <li>Give it a specific name</li>
            <li>Process it - reduce the file size if an image</li>
        </ul>
        <hr>
        <h4>We must have a folder for uploads... e.g public_html/uploads - use a variable $uploads</h4>

        <hr>
        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data">
            
            
            
            <p>Select file:
            
            <input type="file" name="myfile" id="myfile"><br></p>
            
            
            <p>What width would you like this scaled to? 
            
           <select name="resize">
              <option value="300">300</option>
              <option value="400">400</option>
              <option value="500">500</option>
              <option value="600">600</option>
              <option value="800">800</option>
            </select>
            <input type="submit" value="Upload file" name="submit">
            
            
        </form>

        <?php }  ?>
        <hr>


    </main>
    <!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</body>

</html>