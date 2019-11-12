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
            <h1>Image resize</h1>


        </div>


        <?php

     

               

   

                       
          
        //$orig =  __FILE__.$uploads."IMG-20190215-WA0001.jpg";
            $orig =  $uploads."IMG-20190215-WA0001.jpg";
        echo '<img src="'.$orig.'" width="100"><p>';
        
       
            
            if ($resource = imagecreatefromjpeg($orig)) echo 'image resource created' . $resource;
            else echo "failed to create rsource";
 
            
             if (!$imageResized = imagescale($resource, 400)) echo "failed to resize img";
            
        
            echo "<p>reszied - " . $imageResized;
        
        $new_file_name = "newfile.jpg";
        
            imagejpeg($imageResized, $uploads.$new_file_name );
//        echo "after imagejep fn ". imagejpeg($imageResized);
       
//            imagejpeg($imageResized)    
                
   echo '<h2>Resized</h2><img src="'.$uploads.$new_file_name.'">';
 
?>
   


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
