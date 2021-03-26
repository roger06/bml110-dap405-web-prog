<?php

// get json file



// open

// read it

// convert it into an array

$json_file = "data/employees-final.json";

 

$emp_json_data = file_get_contents($json_file);



$emp_array = json_decode($emp_json_data, true);


    foreach($emp_array as $data) {

        // print_r($data);

        echo $data["firstname"] . " ";
        echo $data["lastname"];

        echo '<br>'; 
        echo number_format( $data["salary"], 2);
        echo '<br>';

    }

 
?>

