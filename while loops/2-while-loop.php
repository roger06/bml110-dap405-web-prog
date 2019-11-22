<h1>while loop example</h1>
<?php

//while loop example

    $i = 1;

    while ($i <=10 ) {
	
        echo 'Number is ' . $i;
        echo '<br>' ;
        $i ++; // increment counter or we’ll get stuck
    }
    

?>

<hr>
<?php
  $orders = 20;
    $i = 1;
    while ($i <=$orders ) {
	
        echo 'Order item is ' . $i;
        echo '<br>' ;
        $i ++; // increment counter or we’ll get stuck
    }

?>