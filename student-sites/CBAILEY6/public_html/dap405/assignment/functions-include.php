<?php
include "Tax-Function.php";
function JSON() { //Define a function called JSON which will bring the json file in and decode it into a php array.
    $fileget = file_get_contents("./employees.json");
    $arrayjson = json_decode($fileget, true);
    return $arrayjson;
}

function retrieve($id) { // get a specific employee by passing the employee's ID to this function. eg $john = retrieve("123"); when John's ID is 123.
    $json = JSON();
    foreach ($json as $employee) { // go through each employee in the JSON
        if ($employee['id'] == $id) { // if json we are looping through finds the ID, we got a match! return this whole employee object
            return $employee;
        }
    }
    return false; // return false if we didn't match any

}

function TaxJSON() { //Define a function called JSON2
    $fileget = file_get_contents("./tax-tables.json"); //Getting the actual JSON file
    $Taxjson = json_decode($fileget, true); //Decode the json file into an array called arrayjson2
    foreach ($TaxJSON as $TaxRange) {
    }
    return $TaxJson; //return the json file.

} //End of Function

function PensionCalculation($salary) { //Define a function named PensionCalculation
    $pension = $salary; //Settings the variable $pension to equal the variable $salary which we will pull from the JSON.
    return $pension / 100 * 6 / 12; //Set the pension variable to find 6% of the salary and divide by 12 to output the monthly result.

} //End of Function

function TotalGrossPay($salary) { //Define a function named TotalGrossPay
    return $salary / 12; //Return the salary divided by 12 for monthly output.
} //End of Function

function AdditionalRoles($roles) { //Define a function called AdditionalRoles, Assign it to array of roles.
    foreach ($roles as $role) { //This loop will go through and search the array of roles and list through each value, Listing them as the variable "$role".
        echo "<li>" . $role . "</li>"; //Echo the $role variable.

    }
}

function TotalGrossPayFinal($salary, $rolepayment){ //Define a function named TotalGrossPayFinal
    return TotalGrossPay($salary) + $rolepayment; //This calculates the Total Gross Pay with the Salary + bonus / role bonus.
}//End of Function

function CompanyCar($MonthlyCar) { //Define a function named CompanyCar
    if ($MonthlyCar == "y") { //IF the employees JSON company car key has a value of Y, Return 250(as number) which can be used to add to the list of the deductables from salary.
        return 250; //Returning said number.
    } else return 0; //If the value is anything other that "y" then return 0 as there is no company car.
}//End of Function

function DeductablesTotal($deductablestotal) { //Define a function named Deductables Total
    return PensionCalculation($deductablestotal["salary"]) + CompanyCar($deductablestotal["companycar"]) + TaxCalc($deductablestotal["salary"]); //This calculate all deductables that will come from the salary,
    //This function calculates the total value that will be deducated from the salary. This adds all the employee costs in to one total.                                                                                                                                            //Calculating total of Pension, Company Car and Tax(seperate function file).
}//End of Function

function NetTotal($deductables) { //Define a function named NetTotal
    return TotalGrossPayFinal($deductables["salary"], $deductables["rolepayment"]) - PensionCalculation($deductables["salary"]) - CompanyCar($deductables["companycar"]) - TaxCalc($deductables["salary"]);
    //Calculating the net total (final pay) by taking away the above from the salary.
}

?>

