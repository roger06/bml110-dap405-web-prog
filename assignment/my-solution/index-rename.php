
<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('inc/fns-inc.php');
require_once('inc/header-inc.php');

$jsonfile = 'data/employees-final.json';
$taxfile   = 'data/tax-tables.json';

try {
    
    // $json = @file_get_contents($jsonfile) or die("cannot open file - $jsonfile");
    $json = @file_get_contents($jsonfile);
    $taxjson = @file_get_contents($taxfile); 
} catch (Exception $e) {

   // echo 'Caught exception: ',  $e->getMessage(), "\n";

    require('inc/error-inc.php');
    require('inc/footer-inc.php');
    exit;
}

restore_error_handler();
// https://www.php.net/manual/en/function.restore-error-handler.php


$emp_json_data = json_decode($json);  // 2nd param true returns array, false returns object.
$tax_rates_array = json_decode($taxjson,true); 

// if ($emp_json_data) echo 'json valid';
// else echo 'invalid !!!';
// exit;



$header_array = array("id"=>"ID", "firstname"=>"First Name", "lastname"=>"Last Name", "jobtitle"=>"Position","salary"=>"Salary", "band"=>"Tax Band" ,"netsalary"=>"Net Salary" );
// var_dump( json_decode($json, false));

?>

<main class="container">
<h1>Payroll</h1>
<div class="card">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
        <tr>
<?php

foreach ($header_array as $header){
    echo "<th>" . $header . "</th>";
}
?>
</tr>

<?php
foreach($emp_json_data as $data){
    // var_dump( $data);

    echo '<tr>';
$link ="payslip.php?id=";

$band = getBand($data->salary); 
         

        echo write_cell($data->id, "" , $link);
        echo write_cell($data->firstname);
        echo write_cell($data->lastname);
        echo write_cell($data->jobtitle);
        echo write_cell($data->salary, "GBP");

        echo write_cell($band);
        
        
        echo write_cell( calcTax($data->salary, $band));


    
    echo "</tr>";

}
?>
        </table>
    </div>
</div>

<?php
// exit;

// if  ( is_object($emp_json_data)    ) echo 'json_data is object<br>';
// else echo 'json_data is not object<br>';


// if  ( is_array($emp_json_data)    ) echo 'json_data is array<br>';
// else echo 'json_data is not array<br>';

//exit;
//echo "<pre>";
//
//    print_r($emp_json_data);
//echo "</pre>";

?>

</main>


 






<?php require_once('inc/footer-inc.php');?>