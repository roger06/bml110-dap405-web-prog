<?php 
// payslip page using grid and flex box instead of tables.


if (!isset($_GET["id"]) OR !is_numeric($_GET["id"]) ) {
	echo "No, or invalid employee ID. Returning you to the list.";
	sleep(2);
    header("Location: index-rename.php");
}

else $emp_id = $_GET["id"];
$pagetitle = 'Pay slip :: '. $emp_id;

// echo "Emp id = " .$emp_id;
// exit;
require('inc/fns-inc.php');
require_once('inc/header-inc.php');

$jsonfile = 'data/employees-final.json';
$taxfile = 'data/tax-tables.json';

try {
    
    // $json = @file_get_contents($jsonfile) or die("cannot open file - $jsonfile");
    $json = @file_get_contents($jsonfile);

} catch (Exception $e) {

	echo 'Caught exception: ',  $e->getMessage(), "\n";

    include('inc/error-inc.php');
    include('inc/footer-inc.php');
    exit;
}


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

// TODO test json for errors.
$emp_json_data = json_decode($json);  // 2nd param true returns array, false returns .
$tax_rates_array = json_decode($taxjson, TRUE);  // 2nd param true returns array, false returns .




$header_array = array("id"=>"ID", "firstname"=>"First Name", "lastname"=>"Last Name", "jobtitle"=>"Position","salary"=>"Salary" );
// var_dump( json_decode($json, false));


$emp_found = FALSE; // flag to update when / if record is matched so we don't display errors or empty data.

foreach($emp_json_data as $data){
    // var_dump( $data);

    if ($data->id <> $emp_id) {


		
		continue; // stop looping if it's not the employee we want

	}

	else $emp_found = TRUE;

        $id = $data->id;
        $firstname = $data->firstname;
        $lastname = $data->lastname;
        $full_name = $firstname . " " . $lastname;
        $jobtitle = $data->jobtitle;
        $monthly_take_home = number_format($data->salary / 12,2);
        $ni = $data->nationalinsurance;
        $employmentstart = $data->employmentstart;
        $homeaddress = $data->homeaddress;
		$salary = $data->salary;
		$currency = $data->currency;

		if ($data->companycar == 'y') $companycar = 'Yes';
		else $companycar = 'No';	
		
		if ($data->pension == 'y') $pension = 'Yes';
		else $pension = 'No';
		
		if (!empty($data->department)) $department = $data->department;
		else $department = 'Unspecified';	

		if (!empty($data->linemanager)) $linemanager = $data->linemanager;
		else $linemanager = 'Unspecified';
		// echo "salary = " . $salary;
		$tax_band = getBand($salary);

		
		// echo "band = " . $tax_band;
		$net_salary = calcTax($salary, $tax_band);

		


}  // end foreach

// TODO = handle if the emp ID is not found.

if(!$emp_found) {
 
	$error = "Invalid ID. Cannot find employee";
	
	require('inc/error-inc.php');
	require('inc/footer-inc.php');	
	exit;
}

?>
<main class="payslip">

	<div class="row">
		<h2>Payslip for <?php echo $full_name;?></h2>	
			<div class="table-responsive">
                <div class="table-responsive custom_datatable">						
					<table class="table table-bordered" style="width:100%;margin:auto;text-align:left;" >
                        <tbody>										
							<tr>
                                <td rowspan="2" colspan="2"><h3><?php echo $jobtitle;?></h3></td>
                                <td>National Insurance No.</td>
								<td colspan="2"><?php echo $ni;?></td>
                            </tr>									
                            <tr>
                                <td>Start Date</td>  
								<td colspan="2"><?php echo $employmentstart;?></td>   											
                            </tr>
							<tr>
								<td colspan="2">Department: </td>
								<td colspan="3"><?php echo $department;?></td>
							</tr>
							<tr>
								<td colspan="2">Tax Period</td>
								<td colspan="3"><?php echo date('Y');?></td>
							</tr>
                            <tr>
                                <td>Line manager</td>
                                <td colspan="1"><?php echo  $linemanager;?></td>
                                <td width="150">Tax Band</td>
                                <td colspan="3"><?php echo $tax_band;?></td>
                            </tr>	
							<tr>
								<td rowspan="5"><?php echo $full_name;?></td>
								<td rowspan="5" width="50%"><?php echo $homeaddress;?>	</td>
								<td>Income Tax</td>
								<td> </td>	
								<td> </td>
							</tr>
							<tr>	
								<td>Pension</td>
								 
								<td colspan="2"><?php echo $pension;?></td>

								
							</tr>
							 
							<tr>
								<td>Company car?</td>
								<td colspan="2"><?php echo $companycar;?></td>
							 
							</tr>
						 
							<tr>

								<td>Net pay</td>
								<td colspan="2" class="salary"><?php 
								if ($currency == 'GBP') echo "&pound;";
								
								echo number_format($net_salary,2);?></td>
							
							</tr>
							<tr>
								<td colspan="5">Amount in words :</td>

								<?php

									// TODO - use the PHP number formatting class
									// https://www.php.net/manual/en/class.numberformatter.php
									// $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
									// echo $f->format(123456);

									/* looks like this needs either php.ini change and / or
									other modules installed 
									try it on a VM!
									sudo apt-get install php7.0-intl
									*/

								?>
							</tr>
							 
						</tbody>
					</table>
				</div>
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