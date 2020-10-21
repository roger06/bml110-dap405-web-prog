<?php

$jsonObj = new stdClass(); //empty class in PHP which is used to cast other types to object. 
$jsonObj->name = 'edfer';
$jsonObj->age = 18;
$jsonObj->address = '1 The Avenue';
$jsonObj->job = 'Coal shoveller';

echo '<pre>';

var_dump($jsonObj);
echo '</pre>';


?>