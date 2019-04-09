
<?php


//Arrays


    $myArray = array(1, 6, 99, 777);


    $user_details = array('Roger', 'Holden', 21, 2, TRUE, array('Bob','Susan'));


    $user_details_assoc = array('firstname'=>'Roger',
                                'firstname'=>'Holden',
                                'age'=>21, 2,
                                'member'=>TRUE,
                                'kids'=>array('Bob','Susan'));



// echo $myArray[0];
//echo '<br>';
// echo $myArray[1];
//


//echo "hey Mr " . $user_details[1] . " how are you today?";
//echo "hi " . $user_details[0] . " how are you today?";
//
echo "<pre>";
    print_r($user_details_assoc);
echo "</pre>";

echo 'Hi  ' . $user_details_assoc['lastname'];





?>
