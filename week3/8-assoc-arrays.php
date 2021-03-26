<?php include('../inc/basicstyle.html'); // just to make content easier to read.?>

<h1>PHP 'Associative' arrays</h1>
<p>Associative arrays are indexed by a string, rather than a number</p>

<?php

//arrays
$myarray = array(1,4,6,77,88, 888888);

?>

<h3>This is how we create (declare) an associative array</h3>
<pre>
 
 
 
<pre>

$user_details_assoc = array('firstname'=>'Roger',
                            'lastname'=>'Holden',
                            'age'=>21,
                            'member'=>TRUE);
</pre>


<p>Associative arrays can be useful for 'modelling' data of one 'thing' where it's easier to access the data by name, rather than an index, which we're unlikely to know.</p>
<p>This is very similar to an 'object'. A good example is your student details in Moodle. </p>
<p>We need a loop to access the data or some debugging code.</p>


<?php


//$mixedarray =  array(1,'Hello',world, array(77,88));

//echo doesn't really work with arrays

//use print_r instead (print readable)
//    use with <pre> tags 

   $user_details_assoc = array('firstname'=>'Bob',
                                

                                'lastname'=>'Holden',

                                'age'=>21,
                                'email'=> 'r.holden@chi.ac.uk',

                                'member'=>TRUE,
                                'phones'=>array('iphone', 'samsung', 'moto', 'colours'=>array('red','white','blue'))
 
                            
                            );

// echo $user_details_assoc['firstname'];
// echo '<br>';
// echo $user_details_assoc['phones'];

print_r($user_details_assoc);

exit;


 foreach ($user_details_assoc as $key => $value) {

     echo $key . " = ".$value . "<br>";


 }

?>

 
<br>
<p><a href="8-arrays.php">Simple arrays.</a></p>
<p><a href="8-multi-arrays.php">Multi-dimensional arrays.</a></p>