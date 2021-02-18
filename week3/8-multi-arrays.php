<?php include('../inc/basicstyle.html'); // just to make content easier to read.?>
 
<h1>PHP Multi-dimensional arrays</h1>
<p>Multi-dimensional arrays are extremely powerful, but can be difficult.</p>
<p>Multi-dimensional arrays are arrays of array.</p>
<p>They can be associative arrays (or not).</p>

 

<h3>This is how we create (declare) an associative array</h3>
 
 
 
 
<pre>

$multi = array('cars'=>array('Ford', 'Honda', 'Kia'),
                             'phones'=>array('iPhone', 'Samnsung', 'Mot'),
                             'other'=>array('Cakes'=>array('custard creams', 'Digestives', 'Jafa cakes'))
                               );
</pre>


<p>We need a loop to access the data or some debugging code.</p>


<?php
//    use with <pre> tags 

   $multi = array('cars'=>array('Ford', 'Honda', 'Kia'),
                 'phones'=>array('iPhone', 'Samnsung', 'Moto'),
                  'other'=>array('Cakes'=>array('custard creams', 'Digestives', 'Jafa cakes'))
                               );
echo '<pre>';

print_r($multi);
 echo '</pre>';
?>
<p>We need nested loop to process - which we'll cover later.</p>
<br>
<br>
<a href="8-arrays.php">Simple arrays.</a>