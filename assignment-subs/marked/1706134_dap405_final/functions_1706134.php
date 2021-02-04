<?php

//Convert json from file to array - used a seperate function for this to reduce code duplication.
function fetchjson($filepath){
    $emp_json_data = file_get_contents($filepath);
    
    return json_decode($emp_json_data, true);

}

//fetch employees from json file 
function fetchEmployees(){
    return fetchjson("employees.json");
}

//fetch taxtables from json file
function fetchTaxTables(){
    //fetching the tax brackets 
    $taxtables = fetchjson("tax-tables.json");  
    //and then reversing the array 
    return array_reverse($taxtables);
}

//created a function to calcuate amount of tax for each employee
function taxdue($employee){
    $salary = $employee["salary"];
    $taxdue = 0;
    foreach (fetchTaxTables() as $tax){
       if ($salary <= $tax["maxsalary"]){
           if ($salary >= $tax["minsalary"]){
            //calculating the tax rate & dividing by 100 to convert to decimal(to be usable)
            $rate = $tax["rate"]/100;
            //calculating the amount to tax by subtracting salary & min salary
            $amounttotax = $salary - ($tax["minsalary"]-0.01);
            //created variables - calculating tax due by adding amount to tax and multiplying rate
            $taxdue += $amounttotax * $rate;

            // print ($salary - ($tax['minsalary']-0.01)) . ' - ' . $rate . ' ';
            
            $salary = $tax["minsalary"] - 0.01;

           } 
       }
    
    } 
    //why would I set salary twice when we can set it once above?? :)
    $salary = $employee["salary"];
    //using an if statement to workout if an employee has a company car
    if ("y" == $employee["companycar"]){
       //only want to tax 10000 if the user earns more than 10000 otherwise we're using their total salary
        if ($salary < 10000){
            $amounttotax = $salary;
        } else{
            $amounttotax = 10000;
        }
        //added the tax to the running variable 
        $taxdue += $amounttotax * 0.2;
    }else{
        if ($salary > 150000){
            if ($salary < 10000){
                $amounttotax = $salary;
            } else{
                $amounttotax = 10000;
            }
            //added the tax to the running variable 
            $taxdue += ($amounttotax / 2) * 0.2;
        }
    }  
    return $taxdue; 
}

//Created function which returns employees total salary 
//minus the total tax due and added to the table and printed.  
function salarytakehome($employee){
    $salary = $employee["salary"];
    return $salary - taxdue($employee);
   
}

//Created a function which returns emplyees total salary
//minus the total tax due, divided by 12 to calculate monthly net pay
//added to table and printed
function monthlynetpay($employee){
    return (salarytakehome($employee)/12);
   
}


?>