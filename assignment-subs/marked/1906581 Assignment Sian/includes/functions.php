<?php

 error_reporting(E_ALL);
ini_set('display_errors', 1);




function calculatetaxband ($employee) {
    


$json_file = "data/employees-final.json";

$emp_json_data = file_get_contents($json_file);

$emp_array = json_decode($emp_json_data, true);



$tax_file = "data/tax-tables.json";

$taxfile = file_get_contents($tax_file);

$taxjson = json_decode($taxfile, true);

    $salary = $employee["salary"]; 
    
    
 

if ($salary <= $taxjson[0]["maxsalary"]) {  // if salary more than or equal to 10,000...
    
     $taxband = 1; // they belong to taxband 1

} 
    
if ($salary >= $taxjson[1]["minsalary"] AND $salary <= $taxjson[1]["maxsalary"]) { // if salary more than or equal to 10,000.01 and less than or equal to 40,000...
    
 $taxband =  2; // they belong to taxband 2
    
} 
    
    
if($salary >= $taxjson[2]["minsalary"] AND $salary <= $taxjson[2]["maxsalary"]) { // if salary more than or equal to 40,000.01 and less than or equal to 150,000...
    
    $taxband = 3; // they belong to taxband 3

} 
    
    elseif($salary >= $taxjson[3]["minsalary"]) { // if salary more than or equal to 150,000.01...

          $taxband = 4; // they belong to taxband 4

            }
    
    
return $taxband;

        
} // end calculatetaxband function



function calculatetax ($employee, $taxband) {  //for each employee...

$json_file = "data/employees-final.json";

$emp_json_data = file_get_contents($json_file);

$emp_array = json_decode($emp_json_data, true);



$tax_file = "data/tax-tables.json";

$taxfile = file_get_contents($tax_file);

$taxjson = json_decode($taxfile, true);

$salary = $employee["salary"]; 
    

//tax band 1
if ($taxband == 1 ) { //if employee is in tax band 1
$netsalary = $salary;

    
}
    

 //tax band 2 
if ($taxband == 2) { // if employee is in tax band 2
$taxableamount = $salary - 10000; //the taxable amount is the salary - 10,000 (for those without company car)
$band2 = $taxjson[1]["rate"]/100*$taxableamount; // to work out band 2: 20% of taxabale amount (salary-10,000)
$netsalary = $salary - $band2; // to work out net salary: salary -  20% of taxable amount

    
}
 
 //tax band 2 with company car!  
if ($taxband == 2 AND $employee["companycar"] == "y") { // if employee is in tax band 2 and has company car
$band2 = $taxjson[1]["rate"]/100*$salary; // to work out band 2: 20% of salary
$netsalary = $salary - $band2; // to work out net salary: salary -  20% of taxable amount


}
    

// tax band 3 
if ($taxband == 3 ) { // if employee is in tax band 3
$taxableamount = $taxjson[1]["maxsalary"] - 10000; //the taxable amount is 40,000 - 10,000 (for those without company car)
$band2 = $taxjson[1]["rate"]/100*$taxableamount; // to work out band 2: 20% of 30,000 (taxable amount left in band 2)
$remainder = $salary - $taxjson[1]["maxsalary"]; // to work out remainder to tax: salary - 40,000 
$band3 = $taxjson[2]["rate"]/100*$remainder; // to work out band 3: 40% of remainder (salary - 40,000)
$netsalary = $salary - ($band2 + $band3); // to work out net salary: salary - (band 2 + band 3)

    

}

// tax band 3 with company car!
if ($taxband == 3 AND $employee["companycar"] == "y") { // if employee is in tax band 3 and has company car
$band2 = $taxjson[1]["rate"]/100*$taxjson[1]["maxsalary"]; // to work out band 2: 20% of 40,000 (taxable amount left in band 2)
$remainder = $salary - $taxjson[1]["maxsalary"]; // to work out remainder to tax: salary - 40,000
$band3 = $taxjson[2]["rate"]/100*$remainder; // to work out band 3: 40% of remainder (salary - 40,000)
$netsalary = $salary - ($band2 + $band3); // to work out net salary: salary - (band 2 + band 3)



}
    
    
    
// tax band 4
if ($taxband == 4) { // if employee is in tax band 4
$taxableamount = $taxjson[1]["maxsalary"] - 5000; // the taxable amount is 40,000 - 5,000 (for those without a company car)
$band2 = $taxjson[1]["rate"]/100*$taxableamount; // to work out band 2: 20% of 35,000 (taxable amount left in band 2) 
$remainder = $taxjson[2]["maxsalary"] - $taxjson[1]["maxsalary"]; // to work out remainder to tax: 150,000 - 40,000
$band3 = $taxjson[2]["rate"]/100*$remainder; // to work out band 3: 40% of remainder (150,000 - 40,000)
$remainder2 = $salary - $taxjson[2]["maxsalary"]; // to work out remainder to tax: salary - 150,000
$band4 = $taxjson[3]["rate"]/100*$remainder2; //to work out band 4: 50% of remainder ( salary- 150,000)
$netsalary = $salary - ($band2 + $band3 + $band4); // to work out net salary: salary - (band2 + band3 + band4)

       

}


  // tax band 4 with company car!
if ($taxband == 4 AND $employee["companycar"] == "y") { // if employee is in tax band 4 and has company car
$band2 = $taxjson[1]["rate"]/100*$taxjson[1]["maxsalary"]; // to work out band 2: 20% of 40,000 
$remainder = $taxjson[2]["maxsalary"] - $taxjson[1]["maxsalary"]; // to work out remainder to tax: 150,000 - 40,000
$band3 = $taxjson[2]["rate"]/100*$remainder; // to work out band 3: 40% of remainder (150,000 - 40,000)
$remainder2 = $salary - $taxjson[2]["maxsalary"]; // to work out remainder to tax: salary - 150,000
$band4 = $taxjson[3]["rate"]/100*$remainder2; //to work out band 4: 50% of remainder2 ( salary- 150,000)
$netsalary = $salary - ($band2 + $band3 + $band4); // to work out net salary: salary - (band2 + band3 + band4)

}
      
elseif (!$employee["currency"] == "GBP" AND $employee["companycar"] == "n") { // if currency is in USD and the employee has no company car...
 
$netsalary = $salary; // no tax so the netsalary is equal to salary
    
}

    
      
    return $netsalary;

} // end calculatetax function


function alttaxband () {
    
    
$json_file = "data/employees-final.json";

$emp_json_data = file_get_contents($json_file);

$emp_array = json_decode($emp_json_data, true);
    
$employee = $emp_array;
    

    

$tax_file = "data/tax-tables.json";

$taxfile = file_get_contents($tax_file);

$taxjson = json_decode($taxfile, true);
    
$userinput = $_GET['userinput'];
    
    
if ($userinput <= $taxjson[0]["maxsalary"]) {  // if salary more than or equal to 10,000...
    
     $taxband = 1; // they belong to taxband 1

} 
    
if ($userinput >= $taxjson[1]["minsalary"] AND $userinput <= $taxjson[1]["maxsalary"]) { // if salary more than or equal to 10,000.01 and less than or equal to 40,000...
    
 $taxband =  2; // they belong to taxband 2
    
} 
    
    
if($userinput >= $taxjson[2]["minsalary"] AND $userinput <= $taxjson[2]["maxsalary"]) { // if salary more than or equal to 40,000.01 and less than or equal to 150,000...
    
    $taxband = 3; // they belong to taxband 3

} 
    
   elseif($userinput >= $taxjson[3]["minsalary"]) { // if salary more than or equal to 150,000.01...

          $taxband = 4; // they belong to taxband 4

            }
    
    
    return $taxband;

} //  end alttaxband () function


function altsalary ($taxband) {
    
    
$json_file = "data/employees-final.json";

$emp_json_data = file_get_contents($json_file);

$emp_array = json_decode($emp_json_data, true);
    
$employee = $emp_array;
    

    

$tax_file = "data/tax-tables.json";

$taxfile = file_get_contents($tax_file);

$taxjson = json_decode($taxfile, true);
    
    $userinput = $_GET['userinput'];
    


if ($taxband == 1 ) { //if employee is in tax band 1
$netsalary = $userinput;

    
}
    

 //tax band 2 
if ($taxband == 2) { // if employee is in tax band 2
$taxableamount = $userinput - 10000; //the taxable amount is the salary - 10,000 (for those without company car)
$band2 = $taxjson[1]["rate"]/100*$taxableamount; // to work out band 2: 20% of taxabale amount (salary-10,000)
$netsalary = $userinput - $band2; // to work out net salary: salary -  20% of taxable amount

    
}
    
    
 //tax band 2 with company car!  
if ($taxband == 2 AND isset ($_GET['car'])) { // if employee is in tax band 2 and has company car
$band2 = $taxjson[1]["rate"]/100*$userinput; // to work out band 2: 20% of salary
$netsalary = $userinput - $band2; // to work out net salary: salary -  20% of taxable amount   
 
}
    

// tax band 3 
if ($taxband == 3 ) { // if employee is in tax band 3
$taxableamount = $taxjson[1]["maxsalary"] - 10000; //the taxable amount is 40,000 - 10,000 (for those without company car)
$band2 = $taxjson[1]["rate"]/100*$taxableamount; // to work out band 2: 20% of 30,000 (taxable amount left in band 2)
$remainder = $userinput - $taxjson[1]["maxsalary"]; // to work out remainder to tax: salary - 40,000 
$band3 = $taxjson[2]["rate"]/100*$remainder; // to work out band 3: 40% of remainder (salary - 40,000)
$netsalary = $userinput - ($band2 + $band3); // to work out net salary: salary - (band 2 + band 3)

    

}
    
    // tax band 3 with company car!
if ($taxband == 3 AND isset ($_GET['car'])){ // if employee is in tax band 3 and has company car
$band2 = $taxjson[1]["rate"]/100*$taxjson[1]["maxsalary"]; // to work out band 2: 20% of 40,000 (taxable amount left in band 2)
$remainder = $userinput - $taxjson[1]["maxsalary"]; // to work out remainder to tax: salary - 40,000
$band3 = $taxjson[2]["rate"]/100*$remainder; // to work out band 3: 40% of remainder (salary - 40,000)
$netsalary = $userinput - ($band2 + $band3); // to work out net salary: salary - (band 2 + band 3)


}
    
    
// tax band 4
if ($taxband == 4) { // if employee is in tax band 4
$taxableamount = $taxjson[1]["maxsalary"] - 5000; // the taxable amount is 40,000 - 5,000 (for those without a company car)
$band2 = $taxjson[1]["rate"]/100*$taxableamount; // to work out band 2: 20% of 35,000 (taxable amount left in band 2) 
$remainder = $taxjson[2]["maxsalary"] - $taxjson[1]["maxsalary"]; // to work out remainder to tax: 150,000 - 40,000
$band3 = $taxjson[2]["rate"]/100*$remainder; // to work out band 3: 40% of remainder (150,000 - 40,000)
$remainder2 = $userinput - $taxjson[2]["maxsalary"]; // to work out remainder to tax: salary - 150,000
$band4 = $taxjson[3]["rate"]/100*$remainder2; //to work out band 4: 50% of remainder ( salary- 150,000)
$netsalary = $userinput - ($band2 + $band3 + $band4); // to work out net salary: salary - (band2 + band3 + band4)

       

}
    
    
 // tax band 4 with company car!
if ($taxband == 4 AND isset ($_GET['car'])) { // if employee is in tax band 4 and has company car
$band2 = $taxjson[1]["rate"]/100*$taxjson[1]["maxsalary"]; // to work out band 2: 20% of 40,000 
$remainder = $taxjson[2]["maxsalary"] - $taxjson[1]["maxsalary"]; // to work out remainder to tax: 150,000 - 40,000
$band3 = $taxjson[2]["rate"]/100*$remainder; // to work out band 3: 40% of remainder (150,000 - 40,000)
$remainder2 = $userinput - $taxjson[2]["maxsalary"]; // to work out remainder to tax: salary - 150,000
$band4 = $taxjson[3]["rate"]/100*$remainder2; //to work out band 4: 50% of remainder2 ( salary- 150,000)
$netsalary = $userinput - ($band2 + $band3 + $band4); // to work out net salary: salary - (band2 + band3 + band4)

}
          
    
 return $netsalary;
     
 

} // end altsalary function 




?>
