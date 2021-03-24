<?php include('../inc/basicstyle.html'); // just to make content easier to read.?>

<h1>For loop</h1>

<?php

// exit;



for ($x = 100; $x >= 0; $x--) {

  echo 'The number is '. $x;
  echo '<br>';

    if ($x == 80 ) {

        echo 'found it!';
        exit;

    }
 

 
  
}


    

?>