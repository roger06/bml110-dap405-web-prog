<?php 

require('inc/fns-inc.php');
require_once('inc/header-inc.php');

$jsonfile = 'employees-final.json';

try {
    
    // $json = @file_get_contents($jsonfile) or die("cannot open file - $jsonfile");
    $json = @file_get_contents($jsonfile);

} catch (Exception $e) {

   // echo 'Caught exception: ',  $e->getMessage(), "\n";

    include('inc/error-inc.php');
    include('inc/footer-inc.php');
    exit;
}

restore_error_handler();
// https://www.php.net/manual/en/function.restore-error-handler.php


$emp_json_data = json_decode($json);  // 2nd param true returns array, false returns .

$header_array = array("id"=>"ID", "firstname"=>"First Name", "lastname"=>"Last Name", "jobtitle"=>"Position","salary"=>"Salary" );
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
$link ="payslip.php?id=";

   
    echo "<tr>";
        echo write_cell($data->id, "" , $link);
        echo write_cell($data->firstname);
        echo write_cell($data->lastname);
        echo write_cell($data->jobtitle);

        echo write_cell($data->salary, "GBP");

    
    echo "</tr>";

}
?>
        </table>
    </div>
</div>

<?php
exit;

if  ( is_object($emp_json_data)    ) echo 'json_data is object<br>';
else echo 'json_data is not object<br>';


if  ( is_array($emp_json_data)    ) echo 'json_data is array<br>';
else echo 'json_data is not array<br>';

exit;
echo "<pre>";

    print_r($emp_json_data);
echo "</pre>";

?>

</main>


 






<?php require_once('inc/footer-inc.php');?>