<?php

echo "Hello World...<br>";
//this is as basic as it gets, but proves PHP is working

//this is a comment it is ignored.

//$d = 0;
//
//$d =  '0';
//
//echo $d++ ."\n";
//
//echo ++$d ."\n";


//echo $d++;
//echo "<br>";
//
//echo $d;

//$start = 'Mary had a little';
//$end = 'lamb';
//
//$sentence1 = $start + $end;
//$sentence2 = $start.$end;
//
//echo "sentence 1 = " . $sentence1 . "<br>";
//echo "sentence 2 = " . $sentence2 . "<br>";
//echo "sentence 3 = " . $start . " ". $end. "<br>";


$_POST['x'] = 2;
$_POST['y'] = 2;

$x = $_POST['x'];
$y = $_POST['y'];
echo ("$x" . "+" . "$y =" . ($x * $y*2) . "<br />");



?>