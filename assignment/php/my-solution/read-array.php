
<?php 
 

//step 1
$jsonfile = 'data/employees-final.json';
 
// print_r($jsonfile);
 
//step 2 
$json = @file_get_contents($jsonfile);
 
// print_r($json);
 

 
//step 3
$emp_json_data = json_decode($json, true);  // 2nd param true returns array, false returns object.
  

// echo '<pre>';
// print_r($emp_json_data);
// echo '</pre>';

    foreach($emp_json_data as $row  ) {

        echo $row['firstname'] .' ' ;
        echo $row['lastname'] .' ' ;
        echo $row['salary'] .' ' ;

        echo '&pound;3000';
        echo '<br>';

    }


?>

 