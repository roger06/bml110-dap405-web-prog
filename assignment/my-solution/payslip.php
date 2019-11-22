<?php 
if (!isset($_GET["id"]) OR !is_numeric($_GET["id"]) ) {
    echo "No, or invalid employee ID. Returning you to the list.";
    header("Location: index.php");
}

else $emp_id = $_GET["id"];

// echo "Emp id = " .$emp_id;
// exit;
require('inc/fns-inc.php');
require_once('inc/header-inc.php');

$jsonfile = 'employees-final.json';
$taxfile = '';
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


foreach($emp_json_data as $data){
    // var_dump( $data);

    if ($data->id <> $emp_id) continue; // stop looping if it's not the employee we want

   
        $id = $data->id;
        $firstname = $data->firstname;
        $lastname = $data->lastname;
        $full_name = $firstname . " " . $lastname;
        $jobtitle = $data->jobtitle;
        $monthly_take_home = number_format($data->salary / 12,2);
        $ni = $data->nationalinsurance;
        $employmentstart = $data->employmentstart;
        $homeaddress = $data->homeaddress;

}  // end foreach
?>
<main class="container">
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
								<td colspan="2">Bank Name / Branch : </td>
								<td colspan="3">Bank Name / Branch Name Here</td>
							</tr>
							<tr>
								<td colspan="2">Tax Period</td>
								<td colspan="3">20_ _ to 20_ _</td>
							</tr>
                            <tr>
                                <td>Building Owner Name</td>
                                <td colspan="1">Ward, Block and Door #, Assessment #,UPI #</td>
                                <td width="150">Tax Details</td>
                                <td width="50">RS</td>
								<td width="50">00</td>
                            </tr>	
							<tr>
								<td rowspan="6"><?php echo $full_name;?></td>
								<td rowspan="6" width="50%"><?php echo $homeaddress;?>	</td>
								<td>Property Tax</td>
								<td>500</td>	
								<td>00</td>
							</tr>
							<tr>	
								<td>CESS%</td>
								<td>120</td>
								<td>00</td>
							</tr>
							<tr>
								<td>SWM CESS</td>
								<td>120</td>
								<td>00</td>
							</tr>
							<tr>
								<td>Adjustment if any</td>
								<td>120</td>
								<td>00</td>
							</tr>
							<tr>
								<td>Penalty </td>
								<td>120</td>
								<td>00</td>
							</tr>
							<tr>
								<td>Total</td>
								<td>580</td>
								<td>00</td>
							</tr>
							<tr>
								<td colspan="5">Amount in words :Five Thousand Eighty Rupees Only</td>
							</tr>
							<tr>
								<td>Depositer Signature</td>
								<td>Account #</td>
								<td>Office Manager signature</td>
								<td colspan="2">Cashier Signature <br><br></td>
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