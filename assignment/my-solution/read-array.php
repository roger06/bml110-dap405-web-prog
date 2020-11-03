
<?php 
 

//step 1
$jsonfile = 'data/employees-final.json';
 

//step 2 
$json = @file_get_contents($jsonfile);
 
 
//step 3
$emp_json_data = json_decode($json);  // 2nd param true returns array, false returns object.
  

    
print_r($emp_json_data);

?>

 