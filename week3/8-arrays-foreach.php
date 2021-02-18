<?php include('../inc/basicstyle.html'); // just to make content easier to read.?>

<h1>foreach loop</h1>
<p>Arrays are easily iterated through with this 'control statement'</p>

<?php

//arrays
$myarray = array(1,4,6,77,88, 888888);

?>

<h3>Our array</h3>
<pre>

$myarray = array(1,4,6,77,88, 888888);
</pre>

<h3>The loop structure</h3>


<pre>
foreach ($myarray as $value) {
        echo $value . "&lt;br&gt;";
    }
</pre>
<p>This prints all the values</p>

<?php

foreach ($myarray as $value) {
        echo $value . "<br>";
    }
 ?>
<hr>
<a href="8-assoc-arrays.php">Associative arrays.</a>

 