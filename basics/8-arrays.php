<?php

//arrays
$myarray = array(1,4,6,77,88, 888888);

//or shorthand $array[1,4,6,77,88];


echo $myarray[0];



// foreach ($myarray as $value) {
//
//     echo "<p>Item number = ".$value . "</p>";
//
//
// }






//$mixedarray =  array(1,'Hello',world, array(77,88));

//echo doesn't really work with arrays

//use print_r instead (print readable)
//    use with <pre> tags 

   $user_details_assoc = array('firstname'=>'Roger',
                                'lastname'=>'Holden',
                                'age'=>21,
                                'member'=>TRUE,
                                'kids'=>array('Bob','Susan'));


 foreach ($user_details_assoc as $key => $value) {

     echo $key . " = ".$value . "<br>";


 }

?>
