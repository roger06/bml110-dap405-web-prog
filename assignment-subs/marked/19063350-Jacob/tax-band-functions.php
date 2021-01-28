<?php

function finalaftertax($data, $cc) //this function has been made to allow us to return the net annual salary to both the external php files
{
    $json_file = "data/tax-tables.json";

    $tax_json_data = file_get_contents($json_file);

    $tax_array = json_decode($tax_json_data, true);


    if ($data <= $tax_array[0]["maxsalary"]) { //this if statement makes sure that the calculations only apply to employees who's salary is less than the first tax band's max salary

        $x = $data; //This makes the employee data a variable
        $tax = 0; //this specifies that the tax for this band is zero
        $finalamount = $x - $tax; //this specifies the final amount as an array and calculates the salary minus the tax
        $netmonthly = $finalamount / 12; // this creates the array for the monthly net salary by dividing the annual net salary by 12

        return $finalamount; //This returns the finalamount array when the function is called
       
        
    }


    //Tax Bracket 2

    elseif ($data <= $tax_array[1]["maxsalary"] and $data >= $tax_array[1]["minsalary"] and $cc == 'y') { //the following tax brackets take into account the company car variable as well 


        $x = $data;
        $tax = $tax_array[1]['rate'] / 100 * $x; //the calculations for tax band 2-4 pull the tax rate as a variable using the tax_array array. This is divided by 100 to give a percentage which is then applied to the gross salary
        $finalamount = $x - $tax; //this specifies the final amount as an array and calculates the salary minus the tax
        $netmonthly = $finalamount / 12; //"

        return $finalamount; //"

    
    } elseif ($data <= $tax_array[1]["maxsalary"] and $data >= $tax_array[1]["minsalary"] and $cc == 'n') { //"


        $x = $data - 10000; // 10000 is taken away as the tax free amount
        $tax = $tax_array[1]['rate'] / 100 * $x; //"
        $finalamount = $x - $tax + 10000; //" but the tax free 10000 is added back on
        $netmonthly = $finalamount / 12; //"

        return $finalamount; //"
        
    }

    //Tax Bracket 3

    elseif ($data <= $tax_array[2]["maxsalary"] and $data >= $tax_array[2]["minsalary"] and $cc == 'y') { //"


        $taxb2 = 40000 * $tax_array[1]['rate'] / 100; //"
        $bracket3 = $data - 40000; // This takes away the amount that would fall in the first bracket
        $taxb3 = $tax_array[2]['rate'] / 100 * $bracket3; // This works out the total tax for tax band 3 
        $finalamount = $data - ($taxb2 + $taxb3); //"
        $netmonthly = $finalamount / 12; //"

        return $finalamount; //"


        
    } elseif ($data <= $tax_array[2]["maxsalary"] and $data >= $tax_array[2]["minsalary"] and $cc == 'n') { //"

        $taxb2 = 30000 * $tax_array[1]['rate'] / 100; //"
        $bracket3 = $data - 40000; //"
        $taxb3 = $tax_array[2]['rate'] / 100 * $bracket3; //"
        $finalamount = $data - ($taxb2 + $taxb3); //"
        $netmonthly = $finalamount / 12; //"

        return $finalamount; //"
        
    }

    //Tax Bracket 4

    elseif ($data >= $tax_array[3]["minsalary"] and $cc == 'y') { //"
        $taxb2 = 40000 * $tax_array[1]['rate'] / 100; //"
        $taxb3 = 110000 * $tax_array[2]['rate'] / 100; //"
        $bracket4 = $data - 150000; //" but this is for calculating tax for tax band 4
        $taxb4 = $tax_array[3]['rate'] / 100 * $bracket4; //"




        $finalamount = $data - ($taxb2 + $taxb3 + $taxb4); //"
        $netmonthly = $finalamount / 12; //"

        return $finalamount; //"
        
    } elseif ($data >= $tax_array[3]['minsalary'] and $cc == 'n') { //"

        $x = $data - 5000; //"
        $taxb2 = 35000 * $tax_array[1]['rate'] / 100; //"
        $taxb3 = 110000 * $tax_array[2]['rate'] / 100; //"
        $bracket4 = $data - 150000; //"
        $taxb4 = $tax_array[3]['rate'] / 100 * $bracket4; //"


        $finalamount = $data - ($taxb2 + $taxb3 + $taxb4); //"
        $netmonthly = $finalamount / 12; //"

        return $finalamount; //"
        
    }

    
}

function finalnetmonthly($data, $cc) //this function has been made to allow us to return the net monthly salary to both the external php files

{
    $json_file = "data/tax-tables.json"; 

    $tax_json_data = file_get_contents($json_file); 

    $tax_array = json_decode($tax_json_data, true); 


    if ($data <= $tax_array[0]["maxsalary"]) {

        $x = $data;
        $tax = 0;
        $finalamount = $x - $tax;
        $netmonthly = $finalamount / 12;
        return $netmonthly;

        
        
    }


    //Tax Bracket 2

    elseif ($data <= $tax_array[1]["maxsalary"] and $data >= $tax_array[1]["minsalary"] and $cc == 'y') {


        $x = $data;
        $tax = $tax_array[1]['rate'] / 100 * $x;
        $finalamount = $x - $tax;
        $netmonthly = $finalamount / 12;
        return $netmonthly;


        
    } elseif ($data <= $tax_array[1]["maxsalary"] and $data >= $tax_array[1]["minsalary"] and $cc == 'n') {


        $x = $data - 10000;
        $tax = $tax_array[1]['rate'] / 100 * $x;
        $finalamount = $x - $tax + 10000;
        $netmonthly = $finalamount / 12;
        return $netmonthly;

        
    }

    //Tax Bracket 3

    elseif ($data <= $tax_array[2]["maxsalary"] and $data >= $tax_array[2]["minsalary"] and $cc == 'y') {


        $taxb2 = 40000 * $tax_array[1]['rate'] / 100; //8000
        $bracket3 = $data - 40000;
        $taxb3 = $tax_array[2]['rate'] / 100 * $bracket3;
        $finalamount = $data - ($taxb2 + $taxb3);
        $netmonthly = $finalamount / 12;
        return $netmonthly;



        
    } elseif ($data <= $tax_array[2]["maxsalary"] and $data >= $tax_array[2]["minsalary"] and $cc == 'n') {

        $taxb2 = 30000 * $tax_array[1]['rate'] / 100;
        $bracket3 = $data - 40000;
        $taxb3 = $tax_array[2]['rate'] / 100 * $bracket3;
        $finalamount = $data - ($taxb2 + $taxb3);
        $netmonthly = $finalamount / 12;
        return $netmonthly;

        
    }

    //Tax Bracket 4

    elseif ($data >= $tax_array[3]["minsalary"] and $cc == 'y') {
        $taxb2 = 40000 * $tax_array[1]['rate'] / 100;
        $taxb3 = 110000 * $tax_array[2]['rate'] / 100;
        $bracket4 = $data - 150000;
        $taxb4 = $tax_array[3]['rate'] / 100 * $bracket4;




        $finalamount = $data - ($taxb2 + $taxb3 + $taxb4);
        $netmonthly = $finalamount / 12;
        return $netmonthly;

        
    } elseif ($data >= $tax_array[3]['minsalary'] and $cc == 'n') {

        $x = $data - 5000;
        $taxb2 = 35000 * $tax_array[1]['rate'] / 100;
        $taxb3 = 110000 * $tax_array[2]['rate'] / 100;
        $bracket4 = $data - 150000;
        $taxb4 = $tax_array[3]['rate'] / 100 * $bracket4;


        $finalamount = $data - ($taxb2 + $taxb3 + $taxb4);
        $netmonthly = $finalamount / 12;
        return $netmonthly;

        
    }

    
}

function monthlyTax(&$data) //& allows us to pass entire array to function, pass by reference. This one returns the monthly tax deduction for each employee
{
      $totalTax = $data['salary'] - finalaftertax($data['salary'],$data['companycar']);
     return $totalTax / 12;
}


function totalTax(&$data) // This function allows us to return the total annual tax each employee has to pay annually. 
{
      $totalTax = $data['salary'] - finalaftertax($data['salary'],$data['companycar']);
     return $totalTax;
}

function monthlygross(&$data) // This function allows us to return each employee's monthly gross pay. 
{
      $grossmonthly = $data['salary']/12;
     return $grossmonthly;
}
