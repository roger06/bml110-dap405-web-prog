<?php
error_reporting(-1);
ini_set('display_errors', 'On');
require('inc/fns.inc.php');   // functions
require('inc/data.inc.php');  // additional data (e.g. currency symbols)

$jsonfile = 'employees-final.json';

$json = @file_get_contents($jsonfile) or die("cannot open file - $jsonfile");
$json_data = json_decode($json, true);  // 2nd param true returns object.


if  ( is_object($json_data)    ) echo 'json_data is object<br>';
else echo 'json_data is not object<br>';


if  ( is_array($json_data)    ) echo 'json_data is array<br>';
else echo 'json_data is not array<br>';

//var_dump(serialize($json_data));

//echo '<hr>';
//var_dump($json_data);
//exit;




echo 'error ' . json_last_error();
echo validate_json() ;
// is json valid?



//echo '<pre>'; var_dump($json_data); echo '</pre>';
//echo json_last_error();

//echo '<pre>';
//var_dump( $json_data[0]["firstname"]);
// echo '</pre>';



//echo $json_data[19]["firstname"];
//
$count = 1;
$total_salary_cost = o;
$tax_per_band = array();

foreach ( $json_data as $data) {

     echo '<p>'. $count . ' '. $data['firstname'] . ' '. $data['lastname'] . '</p>';
     echo '<p>Salary: '.  format_number($data['salary'], $data['currency']) . '</p>';

    $total_salary_cost = $total_salary_cost + $data['salary'];


    foreach ($data as $key => $value) {

//        if (!is_array($value)) echo "Key " . $key . " Value " . $value .   "<br>";


    } // end inner foreach

    echo '<hr>';
    $count++;
}// end foreach

echo '<h2>Records processed ' . --$count .'</h2>';
echo '<h2>Total staff bill (annual) ' . format_number($total_salary_cost, 'GBP') .'</h2>';

//echo '<h2>Staff paying no tax ' .  .'</h2>';
//echo '<h2>Staff paying basic tax ' . $total_salary_cost .'</h2>';
//echo '<h2>Staff paying higher tax ' . $total_salary_cost .'</h2>';
//echo '<h2>Staff paying super tax ' . $total_salary_cost .'</h2>';






?>

