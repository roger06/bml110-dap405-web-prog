<?php 
$pagetitle = 'Show data';

require('inc/fns-inc.php');
require_once('inc/header-inc.php');

/*

show raw data in arrays - for debugging only,.

*/
  

 
 

$jsonfile = 'data/employees-final.json';
$taxfile   = 'data/tax-tables.json';

try {
    
    // $json = @file_get_contents($jsonfile) or die("cannot open file - $jsonfile");
    $json = @file_get_contents($jsonfile);
    $taxjson = @file_get_contents($taxfile); 
} catch (Exception $e) {

   echo 'Caught exception: ',  $e->getMessage(), "\n";

    
    exit;
}

restore_error_handler();
// https://www.php.net/manual/en/function.restore-error-handler.php


$emp_json_data = json_decode($json);  // 2nd param true returns array, false returns object.
$tax_rates_array = json_decode($taxjson,true); 
?>

<div class="showdata">



<?php



// show_array($emp_json_data, TRUE);
show_array($tax_rates_array, TRUE);
?>

</div>
<?php


require_once('inc/footer-inc.php');?>

