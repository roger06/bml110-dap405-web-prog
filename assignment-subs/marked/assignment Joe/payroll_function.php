<?php

#Input tax info from json as param and users salary.
#Returns dictionary of tax bracket ID and display text
function getTaxBracket($tax_json, $person){
    #Array to store return data in
    $array = array(
        "tax_band_id" => "",
        "tax_band_message" => ""
    );
    #Check salary against each taxbracket loop.
    foreach ($tax_json as $tax_band){
        if ($person['salary'] >= $tax_band["minsalary"] and $person['salary'] <=$tax_band["maxsalary"]){
            #Assign values to array
            $array["tax_band_id"] = $tax_band["id"];
            $array["tax_band_message"] = ("You're in the " . $tax_band["minsalary"] . " - " . $tax_band["maxsalary"] . " tax band");
        }
    }
    return $array;
}
function calcTaxDeduction($person, $tax_json){
    #USD to GBP exchange rate 1 = 1:1
    $USD_TO_GBP = 1.13;

    $array = getTaxBracket($tax_json, $person);
    $person_tax_id = $array['tax_band_id'];
    $tax_id = 1;
    $total_tax = 0;
    #Assigns salary variable, if salary is paid in USD exchange to GBP for taxation
    if ($person['currency'] == "USD"){
        $salary = $person['salary'] / $USD_TO_GBP;
    }
    else{
        $salary = $person['salary'];
    }
    #If a person has a company car or salary over 150k they loose loose 10,000 tax free so this amount is added to their total tax
    if (($person["companycar"] == "y") or ($salary >= 150000)){
        $total_tax = 10000 * 0.2;
    }
    while ($person_tax_id >= $tax_id){
        $tax_bracket = $tax_json[$tax_id - 1];
        if ($salary >= $tax_bracket["maxsalary"]){
              $taxable_amnt = $tax_bracket["maxsalary"] - $tax_bracket["minsalary"];
        }
        else{
            $taxable_amnt = $salary - $tax_bracket["minsalary"];
        }
        $tax_rate = $tax_bracket["rate"]/100;

        $tax_band_tax = $taxable_amnt * $tax_rate;
        $total_tax += $tax_band_tax;
        $tax_id++;
    }
    if ($person['currency'] == "USD"){
        return $total_tax * $USD_TO_GBP;
    }
    else{
        return $total_tax;
    }
}

function calcPensionDeductions($person){
    $employer_pension_contrib = 0.03;
    $pension_rate =  0.04;
    $pension_array = array(
        "employee_contrib" => 0,
        "employer_contrib" => 0
    );
    if ($person['pension'] == 'y')  {
        $pension_array["employee_contrib"] = ($person['salary']/12) * $pension_rate;
        $pension_array["employer_contrib"] = ($person['salary']/12) * $employer_pension_contrib;
    }

    return $pension_array;
}


function calcPayCheque($person, $tax_json){

    $pay_cheque = array(
        "gross" => 0,
        "tax" => 0,
        "pension" => 0,
        "net" => 0
    );

    $pay_cheque["gross"] = $person["salary"];
    $pay_cheque["tax"] = calcTaxDeduction($person, $tax_json);
    $pay_cheque["pension"] = calcPensionDeductions($person);
    $pay_cheque["net"] = $person["salary"] - ($pay_cheque["tax"] + $pay_cheque["pension"]["employee_contrib"]);

    return $pay_cheque;
}

function getCurrencySymbol($person){
    if ($person['currency'] == "USD"){
        return "$";
    }
    elseif($person['currency'] == "GBP"){
        return chr(163);
    }
    else{
        exit("Program needs manual update to support currency:" . $person['currency']);
    }
}

function displayTableFromEmployeeJson($employee_json, $tax_json){
    #Pass employee_json to post to be read if the user wants to view pdf/advanced details
    $_SESSION["employee_json"] = $employee_json;
    $_SESSION["tax_json"] = $tax_json;
    /*Initializing temp vari    able to design table dynamically*/
    #https://stackoverflow.com/questions/12084698/php-how-to-post-form-data-via-another-file
    $temp = '<form action="pdf.php" method = "post" name = "myForm"><table>'; 
    /*Defining table Column headers depending upon JSON records*/
    $temp .= "<tr><th>Employee name</th>";
    $temp .= "<th>Job role</th>";
    $temp .= "<th>Salary</th>";
    $temp .= "<th>Mobile Number</th>";
    $temp .= "<th>Payslip</th>";
    $temp .= "<th>Advanced details</th></tr>";
    #Dynamically generating rows & columns according to size of employee json
    for($i = 0; $i < sizeof($employee_json); $i++){
        $temp .= "<tr>";
        $temp .= '<form action="pdf.php" method = "post" name = "myForm"><table>';

        $temp .= "<td style='font-size: 14px;'>" . ($employee_json[$i]["firstname"] . " " . $employee_json[$i]["lastname"]) . "</td>";
        $temp .= "<td>" . $employee_json[$i]["jobtitle"] . "</td>";
        $temp .= "<td>" . (getCurrencySymbol($employee_json[$i]) . $employee_json[$i]["salary"]) . "</td>";
        $temp .= "<td>" . $employee_json[$i]["phone"] . "</td>";
        $temp .= '<td><button type = "submit" name = "payroll" value =' . $i . '>View payslip</button></td>';
        $temp .= '<td><button type = "submit" name = "advanced" value =' . $i . '>View advanced details</button></td>';
        $temp .= "</tr>";
    }
    
    /*End tag of table*/
    $temp .= "</table>";
 
    /*Printing temp variable which holds table*/
    echo $temp;
}
    


?>