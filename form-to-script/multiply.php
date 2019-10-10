 
<!--basic script to show we have values from a form.-->
  

<h1> first number <?php echo $_POST["number1"];?></h1>
    
<h1>second number: <?php echo $_POST["number2"];?></h1>
    

<?php

$num1 = $_POST["number1"];
    
$num2 = $_POST["number2"];
   
$total = $num1 * $num2;

?>


<h1> first number (num1) <?php echo $num1;?></h1>
    
<h1>second number: <?php echo $num2;?></h1>

<h1>total: <?php echo $total;?></h1>

<hr>

<!--
<p>Note - this script is also quite dump. I makes no allowance for the integrity of the data or even if there is anything.</p>
    
<h1>Basic debugging</h1>

<p>the print_r function in the 'pre' tag are your best friend for debugging!</p>

<pre>

<?php
print_r($_POST);
?>

</pre>

    

-->


 