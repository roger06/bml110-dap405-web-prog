<?php include('../inc/basicstyle.html'); // just to make content easier to read.?>




<h1>PHP arrays</h1>
<p>Arrays are a data dype with multiple 'elements'</p>



<?php

//arrays
$myarray = array(1,4,6,77,88, "bob");

?>






<h3>This is how we create (declare) an array</h3>
<pre>

$myarray = array(1,4,6,77,88, 888888);
</pre>
<h3>Arrays are zero indexed<br>This is how we print the first element</h3>
<pre>
echo $myarray[2];
</pre>
<p>This prints the first value</p>

<?php
 echo $myarray[2];

//or shorthand $array[1,4,6,77,88];

echo "<p>Print a single element of the array</p>";
echo $myarray[0];
?>

<h3>We cannot print the array like this...</h3>
<pre>
echo $myarray;
</pre>
<?php
      
  echo $myarray;    
      ?>
<hr>

<h3>print_r() is our best friend - especially when used with  &lt;pre&gt; tags</h3>
<?php
echo '<pre>';
  print_r($myarray);
echo '</pre>';
?>
<a href="8-assoc-arrays.php">Associative arrays.</a>

 