<?php

//Date maths to calculate the tax-month on a payslip.
function TaxMonth(){
    $year = date("Y");
    if(date("m")<5) { $year-1; }
    $taxYearStart = new DateTime($year."-04-06 00:00:00");
    $currentMonth = new DateTime(date("j-n-Y", strtotime("last day of previous month")));
    
    $interval = $taxYearStart->diff($currentMonth);
    $taxMonth = $interval->m;
    $taxMonth += 1;

    return $taxMonth;
}

//Returns the band ID as the KEY and the amount of tax paid in that band as the value.
function CalculateTaxBrackets($employee){
    $salary = $employee["salary"];  
    $taxPaidPerBand = array();
    $taxTotal = 0;

    //Only tax those in GBP.
    if($employee["currency"] != "GBP"){
        foreach($_SESSION["tax_array"] as $taxBracket){
            $taxPaidPerBand[$taxBracket["id"]] = 0;
        }
    }

    //Otherwise calculate Tax.
    else{
        foreach($_SESSION["tax_array"] as $taxBracket){

            //If the salary is greater than the top end of the bracket, the person can simply be taxed by the full rate in that band.
            if($salary>$taxBracket["maxsalary"]){

                //If the employee has a company car or earns over £150k then the tax-free allowance is halved (this is actually achieved by halving the lower end of the Band above, in this case bbracket 2).
                if(($employee["companycar"]=="y" || $employee["salary"]) && $taxBracket["id"]==2){
                    $taxPaidPerBand[$taxBracket["id"]] = number_format((($taxBracket["maxsalary"])-$taxBracket["minsalary"]/2)*($taxBracket["rate"]/100), 2, ".", "");
                }
                else{
                    $taxPaidPerBand[$taxBracket["id"]] = number_format(($taxBracket["maxsalary"]-$taxBracket["minsalary"])*($taxBracket["rate"]/100), 2, ".", "");
                }
            }
            //if the salary lies between the brackets then the lower end of the bracket is subtracted from the salary and the remaining amoung is taxed.
            else if($salary>$taxBracket["minsalary"] && $salary<$taxBracket["maxsalary"]){

                //Assuming it's possible for someone to potentially have a company car and earn below the tax threshold (£10k), however unlikely this calculation must be considered again.
                if($employee["companycar"]=="y" && $taxBracket["id"]==2){
                    $taxPaidPerBand[$taxBracket["id"]] = number_format((($salary)-$taxBracket["minsalary"]/2)*($taxBracket["rate"]/100), 2, ".", "");
                }
                else{
                    $taxPaidPerBand[$taxBracket["id"]] = number_format(($salary-$taxBracket["minsalary"])*($taxBracket["rate"]/100),2, ".", "");
                }
            }
            else{
                $taxPaidPerBand[$taxBracket["id"]] = 0;
            }
        }
    }
    
    return $taxPaidPerBand;
}

//Calculates the total tax payable for a years salary. returns a float representing GBP.
function CalculateTaxTotal($employee){
    $taxPaidPerBand = CalculateTaxBrackets($employee);
    $taxTotal = array_sum($taxPaidPerBand);
    return $taxTotal;
}
//Calculate the expected annual take home. returns a float representing GBP.
function CalculateAfterTax($employee){
    $taxTotal = CalculateTaxTotal($employee);
    $afterTax = $employee["salary"] - $taxTotal;    
    return $afterTax;
}
//Calculates the total tax payable for a months salary. returns a float representing GBP.
function CalculateMonthlyTax($employee){
    $taxTotal = CalculateTaxTotal($employee);
    $taxMonthly = number_format($taxTotal/12,2, ".", ""); 
    return $taxMonthly;
}
//Calculate the expected monthly take home. returns a float representing GBP.
function CalculateMonthlyTakeHome($employee){
    $afterTax = CalculateAfterTax($employee);
    $afterTaxMonthly = number_format($afterTax/12,2, ".", ""); 
    return $afterTaxMonthly;
}
//Returns a 2D-Array where the key is the bracket id, and the array contains the top and bottom of each bracket (accomodating for company cars and £150k), the rate, the amount paid, and the amount remaining.
function CalculateAndGetBrackets($employee){
    $taxArray = array();
    $taxPaidPerBracket = CalculateTaxBrackets($employee);
    $remaining = $employee["salary"];
    foreach($_SESSION["tax_array"] as $taxBracket){
        $remaining -= $taxPaidPerBracket[$taxBracket["id"]];
        $taxArray[$taxBracket["id"]] = ["min"=>$taxBracket["minsalary"], "max"=>$taxBracket["maxsalary"], "rate"=>$taxBracket["rate"], "paid"=>$taxPaidPerBracket[$taxBracket["id"]], "remaining"=>$remaining];
    }
    if($employee["salary"] >150000 || $emplpoyee["companycar"] == "y"){
        $taxArray[1]["max"] = $taxArray[1]["max"]/2;
        $taxArray[2]["min"] = $taxArray[1]["max"];
    }
    return $taxArray;
}
?>