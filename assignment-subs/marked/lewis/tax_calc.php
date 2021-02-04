<?php


function calc_tax($salary, $currency, $companycar){


    $json_file_tax = "tax-tables.j son" or die("File not found");
    $tax_json_data = file_get_contents($json_file_tax);
    $tax_array = json_decode($tax_json_data, true);

    if(!is_array($tax_array)){
        throw new Exception('Could not decode the JSON');//looks for error
    }
    
    $jsonError = json_last_error();//gets data and assigns it to a variable 
    if(is_null($tax_array) && $jsonError == JSON_ERROR_NONE){//checks if array contains data
        throw new Exception('Could not decode JSON, file missing.');
    }
    
    if($jsonError != JSON_ERROR_NONE){
        $error = 'Could not decode JSON! ';
    }
    




    foreach($tax_array as $tax_data){
        $tax_id = $tax_data["id"];
        $tax_min = $tax_data["minsalary"];
        $tax_max = $tax_data["maxsalary"];
        $tax_rate = $tax_data["rate"];
              
    }





if ($currency != "GBP"){ //allows other conversions to be added later on if needed
    if ($currency == "USD"){
        $usd_to_gbp_conversion = 1.335365; //as of 26/11/2020
        
        $salary = $salary / $usd_to_gbp_conversion;
        
    }
    
}

//echo $salary;

if ($companycar == "y"){  //if they have a compnay car they must pay tax on first 10k



    if ($salary >= $tax_array[3]["minsalary"]){//first band for those over 150k, 20% tax on first 10k
        $rem = $salary - $tax_array[2]["maxsalary"];//although is id3 it starts at 0        
        $tax = ($rem * ($tax_array[3]["rate"]/100)) + (($tax_array[2]["maxsalary"]-($tax_array[2]["minsalary"]))*(($tax_array[2]["rate"])/100)) + (($tax_array[1]["maxsalary"]) * (($tax_array[1]["rate"]/100))); //has to pay the tax on first 10k so is included in the first bracket
     
    }

    if ($salary >= $tax_array[2]["minsalary"] && $salary <= $tax_array[2]["maxsalary"]){
        $rem = $salary - $tax_array[1]["maxsalary"];
        $tax = ($rem * ($tax_array[2]["rate"])/100)+ ( $tax_array[1]["maxsalary"] * ($tax_array[1]["rate"]/100));
         
    }
    
    if ($salary <= ($tax_array[1]["maxsalary"])){   
                 
        $tax = ($salary * ($tax_array[1]["rate"]/100));
        
    } 
    

}//end of compnay car = y if statment
    //}

elseif ($companycar == "n"){


    if ($salary >= $tax_array[3]["minsalary"]){//first band for those over 150k, 20% tax on first 10k
        $rem = $salary - $tax_array[2]["maxsalary"];//although is id3 it starts at 0        
        $tax = ($rem * ($tax_array[3]["rate"]/100)) + (($tax_array[2]["maxsalary"]-($tax_array[2]["minsalary"]))*(($tax_array[2]["rate"])/100)) + (($tax_array[1]["maxsalary"]) * (($tax_array[1]["rate"]/100))); //has to pay the tax on first 10k so is included in the first bracket
          //has to pay the tax on first 10k so is included in the first bracket
       
    }
    //first 10k is not free if over 150k //those with car do not get first 10k free as well - would fall under 20% tax bracket


if ($salary >= $tax_array[2]["minsalary"] && $salary <= $tax_array[2]["maxsalary"]){//
    $rem = $salary - $tax_array[1]["maxsalary"];
    
    $tax = ($rem * ($tax_array[2]["rate"])/100)+ ( ($tax_array[1]["maxsalary"]-$tax_array[0]["maxsalary"]) * ($tax_array[1]["rate"]/100));
    
}

if ($salary >= $tax_array[1]["minsalary"] && $salary <= $tax_array[1]["maxsalary"]){
    $rem = $salary - $tax_array[0]["maxsalary"];
        $tax = ($rem * ($tax_array[1]["rate"])/100);
     
} 
if ($salary <= $tax_array[0]["maxsalary"]){
    
    $tax = 0;
  
}
}

if ($currency !== "GBP"){ //allows other conversions to be added later on if needed
    if ($currency == "USD"){
        $gbp_to_usd_conversion = 0.7488589; //as of 26/11/2020

        $salary = $salary / $gbp_to_usd_conversion;
                      
        $tax = $tax * $usd_to_gbp_conversion;
        
    }
}

$net_salary = $salary - $tax;
$monthly_net_salary = $net_salary / 12;
$monthly_net_salary_rounded = number_format((float)$monthly_net_salary, 2, '.','');
$monthly_tax = $tax / 12 ; 
$monthly_tax_rounded = number_format((float)$monthly_tax, 2, '.','');//rounds the numbers to correct format for currency


return array($monthly_net_salary_rounded, $monthly_tax_rounded);

}





?>



