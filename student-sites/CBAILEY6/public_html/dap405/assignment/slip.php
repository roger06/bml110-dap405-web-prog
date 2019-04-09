<html> <!--Opening HTML-->
<head> <!--Opening Head-->
	<style> /* Opening Style Tag */
	body {
		 overflow-y: scroll;
	 	 overflow-x: hidden; /* This used to hide the scroll bars from the page. */
	 }
	 img {
	 	border-radius: 50%; /* Rounding the Profile Images. */
	 }
	</style> <!-- End of the style tags -->
	<script>
	   function printfunction() { //This functionw will be called in a button.
	      window.print(); //This function uses the .print method to let the user print the webpage.
	   }
	</script> <!-- End of Javascript tags -->
<?php //Initiate PHP.
include "header.php"; //Include the header.php to the page, Header contains commented code.
?>
<?php
include "functions-include.php"; //Including the Functions file, The function file contains the find employee function and the function to decode the JSON into a                                 //php array
$IDFind = $_GET['id']; //Set the Variable ID Find to Request the ID From the JSON file once loaded.
//This is printing the ID of the employee at the top of their payslip.
$output = retrieve($IDFind); //Variable set to retrieve their ID, If it cannot find the ID it will produce the error and will stop with the die method.
//I have set this varible to "DIE" so it doesn't loop constantly searching for an ID that doesn't exist.
if (!$output) { //If statement begins, Passing the parameter $output.
    die("Employee Doesn't Exist on Payroll"); //Stoping if ID Not found.
}

if(isset($_POST["payrise"])) { //Checkign to see if the Payrise has already been set within the webpage, If not, Output the salary multiplied by 1% to simulate a payrise.
	$output["salary"] = $output["salary"] * 1.01;
}
?> <!-- End of PHP -->
<title>Payslips</title> <!-- Sets the title of the page to Payslips, This will display in the browser tab. -->
</head> <!-- End of the head tags -->

<body> <!-- Start of Body tag -->
	<div class="row">  <!-- Used to style the div to the bootstrap style of row. -->
		<div class="col-md-4 text-center"> <!-- col-md-4 text-center allows the page to center the div. -->
			<h3>Employee Name</h3>
			<b><?php echo $output["firstname"] . " " . $output["lastname"]; //This outputs the name and lastname within the div. ?></b>
		</div> <!-- End of the DIV -->

		<div class="col-md-4 text-center"> <!-- col-md-4 text-center allows the page to center the div. -->
			<h3>Employee Job Title</h3> <!-- Heading of Employee Job Title.-->
			<b><?php echo $output["jobtitle"]; //Echo the jobtitle within the div from the value in the json. ?></b>
		</div>

		<div class="col-md-4 text-center" style="margin-top: 30px; right: 50px;"> <!-- Inline styling for ease of use and quick editing -->
			<form method="post" action="slip.php?id=<?php echo $output["id"]; //Using the post method within a form that will hold the payrise button ?>">
				<button class="btn btn-info" name="payrise" type="submit">Calculate Pay Rise</button> <!-- Button that when presed will calculate pay rise, This calls the above JS -->
				<button class="btn btn-info" data-target="#myModal" data-toggle="modal" type="button">JSON Export</button> <button class="btn btn-info" onclick="printfunction()" type="button">Print Payslip</button> <a href="Dashboard.php"button class="btn btn-info" type="button">Back</a></button>
			</form> <!-- End of Form -->
		</div> <!-- End of Div -->
	</div> <!-- End of Parent DIV -->

	<!-- Modal starts here.-->
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog"> <!-- Parent Div -->
			<!-- Modal content-->

			<div class="modal-content"> <!-- Child Div -->
				<div class="modal-header"> <!-- 2nd Child Div -->
					<button class="close" data-dismiss="modal" type="button">&times;</button> <!-- Button that user will press to open the Modal -->

					<h4 class="modal-title">JSON String</h4> <!-- Title of the Modal -->
				</div>

				<div class="modal-body"> <!-- Main Div holding the Modal content. -->
					<pre><?php //Initiate PHP
							$json_formatted = json_encode($output, JSON_PRETTY_PRINT); // This encodes the JSON using the PRETTY PRINT method to text wrap it within the modal.
							echo $json_formatted //Echo the variable holding the JSON. ?>
					</pre>
				</div>

				<div class="modal-footer">
					<button class="btn btn-default" data-dismiss="modal" type="button">Close</button> <!-- Button -->
				</div> <!-- End of Modal Div -->
			</div> <!-- End of 2nd Child Div -->
		</div> <!-- End of the 1st Child Div -->
	</div> <!-- End of Modal Parent Div -->

	<div class="col-md-12 text-center"> <!-- Div to hold the below content -->
	</div>
		<p style="border-bottom: 5px solid #bce8f1"></p> <!-- Creates the light blue border under the employee infomation, Using inline styling for ease of use -->
	<div class="container"> <!-- Container div that will hold content -->
		<div class="row"> <!-- Nested Div -->
			<div class="col-xs-12"> <!-- Nested div to organise content into columns -->
				<div class="invoice-title"> <!-- Starting Div that will hold the payslip infomation -->
					<h2>Payslip for Current Month</h2><br> <!-- Heading -->
					<h3 class="pull-right"><i style="font-size: 15px;">Employee ID:</i><?php echo $output["id"]; //Outputs the ID of the employee.?> </h3>
					</h3>
				</div> <!-- End of payslip employee info -->
				<hr> <!-- Hoirzontal Row tag -->
				<div class="row">
					<div class="col-xs-6">
						<address>
							<strong>Payment To:</strong> <?php echo $output["firstname"] . " " . $output["lastname"]; //Echo the first and last name.?><br>
							<?php echo $output["homeaddress"]; //Echo the homeaddress. ?><br>
							<strong>National Insurance No:</strong><br>
							<i><?php echo $output["nationalinsurance"]; //Echo the NI of the employee. ?></i>
						</address>
					</div>
					<img src="<?php echo "./ProfilePic/" . $output["id"] . ".jpg"; ?>" alt=" ID Picture." height="100" width="100"> <!-- This creates the profile picture image, With a
																																		a height and width of 100px, Uses the ID
																																	    of the employee to look for the saved image in the
																																	    files. -->
				</div>

				<div class="row">
					<div class="col-xs-6">
						<address>
							<strong>Payment Method:</strong><br>
							Account : ******* Sort: : ** ** **<br> <!-- Generic Banking Info, 6 digits sort code and acc number -->
							<?php echo $output["homeemail"]; //Echo the email of the employee.?>
						</address>
					</div>

					<div class="col-xs-6 text-right">
						<address>
							<strong>Payment Date:</strong><br>
							<?php echo date("d-m-Y"); ?>
						</address>
					</div> <!-- end of Column div -->
				</div> <!-- end of row div -->
			</div>
		</div>

		<div class="row"> <!-- start of new row -->
			<div class="col-md-12"> <!-- organise into a predefined column style -->
				<div class="panel-info"> <!-- Create a bootstrap panel -->
					<div class="panel-heading">
						<h3 class="panel-title"><strong>Payment Breakdown - Before Tax (Monthly)</strong>
						</h3>
					</div> <!-- End of panel heading div -->

					<div class="panel-body"> <!-- start of panel body -->
						<div class="table-responsive"> <!-- Creating a responsive table -->
							<table class="table table-condensed"> <!-- Condensing the table -->
								<thead> <!-- Table head -->
									<tr> <!--- Table Row -->
										<td><strong>Payroll - <?php echo $output["id"]; //Echo the Employee id?></strong>
										</td> <!-- End of Table Data -->

										<td class="text-center"><strong>Monthly Payment</strong>
										</td> <!-- End of Table Data -->

										<td class="text-right"><strong>Total Gross PAY</strong>
										</td> <!-- End of Table Data -->
									</tr> <!-- End of Table Row -->
								</thead>

								<tbody>
									<tr>
										<td>Gross Pay</td>

										<td class="text-center">&pound;<?php echo number_format(TotalGrossPay($output["salary"]), 2); //Echo the GrossPay using number format to format the pay
																																	 // to two decimal places.
																																	// Using the parameter of salary.?>
										</td> <!-- End of Table Data -->

										<td class="text-right">&pound; <!-- Using HTML Character Set so all browser identify it as £ sign -->
										<?php echo number_format(TotalGrossPay($output["salary"]), 2); //Echo the GrossPay using number format to format the pay
																																	 // to two decimal places.?>
										</td> <!-- End of Table Data -->
									</tr> <!-- End of Table Row -->
								</tbody>

								<tbody>
									<tr>
										<td>Additonal Role(s): <br><ul></ul><?php AdditionalRoles($output["previousroles"]); //Echo the function of AdditionalRoles, Passing through
																															// the JSON key of Previous Roles.?></td> <!-- End of Table Data -->

										<td class="text-center">&pound;<?php echo number_format($output["rolepayment"], 2); //Echo the Role Payment value in the JSON using number format to format the pay
																																	 // to two decimal places.
																																	// Using the parameter of rolepayments ?></td> <!-- End of Table Data -->

										<td class="text-right">&pound;<?php echo number_format(TotalGrossPayFinal($output["salary"], $output["rolepayment"]), 2);
																													//Caling the final gross pay function.?></td>
									</tr> <!-- End of Table Row -->
								</tbody> <!-- End of Table Body -->
							</table>
						</div>
					</div>
				</div>
			</div>
		</div> <!-- End of Section Div -->

	<div class="row"> <!-- New Section -->
    	<div class="col-md-12"> <!-- New column -->
    		<div class="panel-info"> <!-- New Panel -->
    			<div class="panel-heading"> <!-- Next Heading -->
    				<h3 class="panel-title"><strong>Payment Breakdown - After Tax (Monthly)</strong></h3> <!-- Heading -->
    			</div> <!-- end of panel heading div -->
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed"> <!-- Create a condensed table -->
    						<thead> <!-- Table Head -->
                                <tr> <!-- Table row -->
        							<td><strong>Item</strong></td> <!-- The following Table headings -->
        							<td class="text-center"><strong>Price</strong></td>
        							<td class="text-center"><strong>Type</strong></td>
        							<td class="text-right"><strong>Totals</strong></td>
                                </tr> <!-- End of Table Row -->
    						</thead> <!-- End of Table head -->
    						<tbody> <!-- Table body -->
    							<tr> <!-- The following all sit under the headings -->
    								<td>Tax</td> <!-- Tax Item -->
    								<td class="text-center"> <!-- Class to center all text -->
    								<?php // Start PHP
									$TaxFinal = TaxCalc($output['salary']); //Echo the Tax function.
									echo "&pound;" . number_format($TaxFinal); //Format the final output and use HTML charset for £.
									?></td>
    								<td class="text-center">Tax</td>
    								<td class="text-right"><?php echo "&pound;" . number_format($TaxFinal); // Echo in totals calculation.?></td>
    							</tr>
                                <tr>
        							<td>Pension</td>
    								<td class="text-center">&pound;<?php echo number_format(PensionCalculation($output["salary"]), 2); //Echo the Pension Function. ?></td>
    								<td class="text-center">6%</td>
    								<td class="text-right">&pound;<?php echo number_format(PensionCalculation($output["salary"]), 2); //Echo the Pension Function in the totals section.?></td>
    							</tr>
                                <tr>
            						<td>Company Car(subject to Employee)</td>
    								<td class="text-center">&pound;<?php echo number_format(CompanyCar($output["companycar"]), 2); //Echo if the function to calculate if employee has a company car. ?></td>
    								<td class="text-center">1</td>
    								<td class="text-right">&pound;<?php echo number_format(CompanyCar($output["companycar"]), 2); //Echo if the function to calculate if employee has a company car. ?></td>
    							</tr>
    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Total of Deductables</strong></td>
    								<td class="thick-line text-right">&pound;<?php echo number_format(DeductablesTotal($output), 2); //Echo the Deductables function?></td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Final(TOTAL) Net Pay</strong></td>
    								<td class="no-line text-right">&pound;<?php echo number_format(NetTotal($output), 2); //Echo the Final NetPay Function. ?></td>
    							</tr> <!-- End of Table Row -->
    						</tbody> <!-- End of Table Body -->
    					</table> <!-- End of Table -->
    				</div>
    			</div>
    		</div>
    	</div>
    </div> <!-- End of Parent DIV. -->
</body> <!-- End of Body -->
</html> <!-- End of html tag -->
