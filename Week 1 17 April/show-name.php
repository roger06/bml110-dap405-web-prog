 
<!--basic script to show we have values from a form.-->
  

<h1>Your first name is: <?php echo $_POST["firstname"];?></h1>
    
<h1>Your last name is: <?php echo $_POST["lastname"];?></h1>
 


<?php

$salary = $_POST["salary"];
$other = $_POST["other"];


?>


<h1>Your name is : <?php echo $_POST["firstname"] . ' ' .$_POST["lastname"];?></h1>


<hr>

<p>Note - this script is also quite dump. I makes no allowance for the integrity of the data or even if there is anything.</p>
    
<h1>Basic debugging</h1>

<p>the print_r function in the 'pre' tag are your best friend for debugging!</p>

<pre>

<?php
print_r($_POST);
?>

</pre>

    



 