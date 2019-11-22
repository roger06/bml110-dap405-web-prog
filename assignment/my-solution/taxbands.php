<?php 

require('inc/fns-inc.php');
require_once('inc/header-inc.php');

$taxfile   = 'data/tax-tables.json';

try {
    
    // $json = @file_get_contents($jsonfile) or die("cannot open file - $jsonfile");
    $taxjson = @file_get_contents($taxfile); 
} catch (Exception $e) {

    echo 'Caught exception: ',  $e->getMessage(), "\n";

    include('inc/error-inc.php');
    include('inc/footer-inc.php');
    exit;
}

restore_error_handler();
// https://www.php.net/manual/en/function.restore-error-handler.php


$tax_rates_array = json_decode($taxjson, true); 

// var_dump($tax_rates_array);
// exit;

$header_array = array("name"=>"Name", "description"=>"Description", "minsalary"=>"Min Salary", "maxsalary"=>"Max Salary","rate"=>"Rate", "exceptions"=>"Exceptions");
// var_dump( json_decode($json, false));

?>

<main class="container">
<h1>Tax Rates <?php echo date("Y");?></h1>
<div class="card">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
        <tr>
<?php

// echo "<pre>"; print_r($tax_rates_array); echo "</pre>";

// print header row
foreach ($header_array as $header => $label){
    echo "<th>" . $label . "</th>";
}
?>

</tr>


<?php
 foreach($tax_rates_array as $data){
    echo "<tr>";  
    foreach ($header_array as $header => $label){
        

        // handle the exceptions field - this is probably much easier as an array than object!
        

        echo "<td>";

        if (is_array($data[$header])) {
          
            $implode = '';

            foreach ($data[$header] as $key => $value) {

                foreach ($value as $key => $data)
                $implode .= $key . ": " .$data;
                $implode .= ", ";

            }
            echo substr($implode, 0, -2);
            // $header = $implode;
            // echo "<pre>"; print_r($data[$header]); echo "</pre>";

        }

        else {
            if ($header == 'minsalary' OR $header == 'maxsalary'){
               echo "&pound;"; 
               $data[$header] = number_format($data[$header],2);
            } 

            
            echo $data[$header];
        
        }
            if ($header == 'rate') echo '%';


        echo "</td>";
        }
    
   

echo "</tr>";
} // end outer foreach


// exit;



// foreach($tax_rates_array as $data){
//     // var_dump( $data);


//     echo "<tr>";


//         echo write_cell($data->name);
//         // echo write_cell($data->firstname);
//         // echo write_cell($data->lastname);
//         // echo write_cell($data->jobtitle);
//         // echo write_cell($data->salary, "GBP");

//         // echo write_cell($band);
        
        
//         // echo write_cell( calcTax($data->salary, $band));


    
//     echo "</tr>";

// }
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

// exit;
// echo "<pre>";

//     print_r($emp_json_data);
// echo "</pre>";

?>


</main>






<?php require_once('inc/footer-inc.php');?>