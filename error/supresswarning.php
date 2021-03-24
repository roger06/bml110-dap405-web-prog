<H1>Supress a warning</H1>
<p>It's usually preferable to fix the issue but we can supress a warning with the @ sign prefixed (usually to a function).</p>
<?php


$myarray = array(1,2,3);

// echo $myarray[1];
echo @$myarray[4];   // this will cause a warning
// TODO - fix this 


// echo @$myarray[4];   // this will cause a warning



echo '<p>the code goes on!</p>'


?>