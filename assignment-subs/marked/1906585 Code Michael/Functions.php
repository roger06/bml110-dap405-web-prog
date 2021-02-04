<?php
	
	function CalculateTax($Val, $Car){
		$TaxInfo = GetJsonData("tax-tables.json");
		$NetProfit = Tax($TaxInfo, $Val, $Car);
		return $NetProfit;
	}

	function Tax($TaxInfo, $Salary, $Car){
		foreach ($TaxInfo as $TaxRow){
			//Gets the TaxBand and the ID by checking if the salary is less than the max salary
			if ($Salary <= $TaxRow['maxsalary']){
				$TaxID = $TaxRow['id'];
			break;
			}
		}
		//Checks if the employee has a car or does not qualify for Personal allowance
		if ($Car == "y" or $TaxID == array_keys($TaxInfo[count($TaxInfo) - 1])){
			unset($TaxInfo[0]);
			$RemoveBand = 1;
		} else{
			$RemoveBand = 0;
		}
		$TaxAmountLeft = $Salary;
		$TotalTax = 0;
		foreach ($TaxInfo as $DeductTax){
			if ($TaxID >= $DeductTax['id']){
				//Gets the range from min tax and max tax
				$TaxDiff = $DeductTax['maxsalary'] - $DeductTax['minsalary'];
				//Below will only be executed once, as it adds 10,000 to the 20% band
				if ($RemoveBand == 1){
					$TaxDiff += 10000;
					$RemoveBand +=1;
				}
				if ($TaxAmountLeft - $TaxDiff <= 0){
					$TotalTax = $TotalTax + ($TaxAmountLeft * ($DeductTax['rate']/100));
				} else {
					$TaxAmountLeft -= $TaxDiff;
					//Total tax equals Prev Tax + range taxed
					$TotalTax = $TotalTax + ($TaxDiff * ($DeductTax['rate']/100));
				}
			} else{
			break;
			}
		}
		//Returns the net salary
		return $Salary - $TotalTax;
	}

	function GetJsonData(string $FileName){
		//Error handles Both checking if the file exists or checking if
		//Json file Decodes correctly
		if (!file_exists($FileName)){
			die("<p style='text-align:center;'>Sorry an error occured retrieving the data. 
			Please Try again or contact a system administrator.<br><br>
			<a type='button' class='btn btn-outline-danger' href='login.php' >Return To Login Page</a></p>");
		}
		$FileData = file_get_contents($FileName);
		$FileData = json_decode($FileData, true) or die("<p style='text-align:center;'>
		Sorry an error occured retrieving the data. 
		Please Try again or contact a system administrator.<br><br>
		<a type='button' class='btn btn-outline-danger' href='login.php'>Return To Login Page</a></p>");
		return $FileData;
	}

	function GetUserArray($UserID){
		//Loops through the Employee array
		$EmpData = GetJsonData("employees-final.json");
		foreach ($EmpData as $EmpKey => $EmpVal){
			//If the current index of id equals the UserID from the $_GET
			//It will return the Employees array details
			if ($EmpVal['id'] == $UserID){
				return $EmpVal;
			}			
		}
	}

	function IterateArray(array $empArray, array $Columns){
		foreach ($empArray as $Array2 => $Val3){
			//loops through each array and opens a row
			echo "<tr>";
			foreach ($Val3 as $Arr => $Val){
				//If the Array element is in Colums (The array of items in the table.)
				if (in_array($Arr, $Columns)){
					if (strtoLower($Arr) == "salary"){
						//Iterates through the salary 
						//Checks if the currency is different to 
						if ($Val3['currency'] == "USD"){
							//converts usd to gbp
							$Val *= 0.75; //GBP To USD As of 25/11/2020
						}
						if ($Val3['companycar'] == "y"){
							//Calculate Tax, passing in the parameter of having a company car, and returns net salary
							$NewVal = CalculateTax($Val, "y");
						} else {
							//Calculate Tax without car, and returns the net salary
							$NewVal = CalculateTax($Val, "n");
							//echo "$NewVal ";
						}
						if ($Val3['currency'] == "USD"){
							$Val *= 1.33; // USD To GBP As of 25/11/2020
							$NewVal *= 1.33; // USD To GBP As of 25/11/2020
						}
						$TaxPaid = $Val - $NewVal; //Calculates the total tax paid
						$Val = number_format($Val,2);
						echo "<td>&pound;$Val</td>"; //helps render in pound symbol depending on browser 

						$MonthlyNet = $NewVal/12; //Calculates the monthly tax
						
						$TaxPaid = number_format($TaxPaid/12, 2);
						$MonthlyNet = number_format($MonthlyNet, 2);
						echo "<td>&pound;$MonthlyNet</td>";//Puts the Net Salary or Tax in the row,
						echo "<td>&pound;$TaxPaid</td>";
						//will probs be net sal cos its needed
					} elseif (strtolower($Arr) == "id" or strtolower($Arr) == "companycar"){
						if ($Arr == "id"){
							echo "<td>$Val</td>";
							$UserID = $Val; //Can use the USerID to pass in as a query string.
						}
					} else {
						echo "<td>$Val</td>";
					}
				}
			}
			echo "<td><a type='submit' class='btn btn-success' href='EmployeePayslip.php?UserID=$UserID'>Go To Employee</a></td></tr>";
			//echos out a button at the end of each row.
			echo "</tr>";
		}

		//return $TableItems;
	}

	function IterateTaxArray($Array, $Columns){
		foreach ($Array as $Array2 => $Val3){
				//loops through each array and opens a row
				echo "<tr>";
			foreach ($Val3 as $Arr => $Val){
				if (in_array($Arr, $Columns)){
					if ($Arr == "minsalary" or $Arr == "maxsalary"){
						$Val = number_format($Val,2);
						echo "<td>&pound;$Val</td>";
					} elseif ($Arr == "rate") {
						echo "<td>$Val&#37;</td>";
					} else{
						echo "<td>$Val</td>";
					}
				}
			}
			echo "</tr>";
		}
	}

	function GetHomeTable($Columns, $FileData){
			IterateTaxArray($FileData, $Columns);

	}


	function HandleSessionVars(string $SessionType, $SesName ,$Value){
		switch ($SessionType) {
			case "Start":
				$_SESSION["$SesName"] = "$Value";
			break;
			case "Edit":
				$_SESSION["$SesName"] = "$Value";
			break;
			case "Remove":
				unset($_SESSION["$SesName"]);
			break;
		}
	}

?>