<?php

// currency look up;

// functions 

set_error_handler(
    function ($severity, $message, $file, $line) {
        throw new ErrorException($message, $severity, $severity, $file, $line);
    }
);


function write_cell($data, $format='', $link=''){

    // echo "fn called .data = " . $data;


    if (!isset($data)) {
        echo "no cell data!";
        exit;
    }

    $row = "<td>";
 
    if (is_numeric($data) AND $format == "GBP" ) {
        $data = number_format($data, 2);
        $row .= "&pound;";
    }

    if ($link) {
        $data = "<a href='".$link.$data."'>".$data."</a>";
    }



    // $data = "<a href='payslip.php?id=".$data."'>".$data."</a>";
    $row .= $data;

    // $row .= format($data, $format);
    
    $row .= "</td>";
    return $row;


} // end function write_cell


function calcTax($salary, $band){
    // $tax = 0;
    if (!isset($salary)) die("no salary");
    if (!is_numeric($band))  die("no tax band");
    
    global $tax_rates_array;

    switch ($band) {
        case 1: // zero tax. Simple calculation
        $netsalary = $salary;
            break;
        case 2:  // 10001 - 40000
                // still quite simple as we know there's only one band to apply
                // so we just need to deduct the tax-free portion firt
              
            $tax = ($salary- $tax_rates_array[0]["maxsalary"]) * ($tax_rates_array[1]["rate"] /100 );

            $netsalary = $salary- $tax;

            break;
        case 3:   // 40001 - 150000
        //echo 'band 3';
            // more comlex, but we know if we're in this band we have
            // £10000 tax free - we don't need to substract this - we can just work
            // backwards to work out the tax on band 2 and 3 
            //and £30000 at 20%
            // £10k = $tax_rates_array[0]["maxsalary"]
            // the portion to be taxed at 20% is $tax_rates_array[1]["maxsalary"] - $tax_rates_array[0]["minsalary"]
            // the remained is taxed at 40% $tax_rates_array[2]["rate"]
                // so we need to calculate the remainder = $salary - $tax_rates_array[2]["maxsalary"]

            $firsttaxtable =     $tax_rates_array[1]["maxsalary"] - $tax_rates_array[1]["minsalary"] ;

            $secondtaxable = $salary - $tax_rates_array[1]["maxsalary"];
            //  cho "seecond taxable = ". $secondtaxable."<br>";

            

            $tax = $firsttaxtable * ($tax_rates_array[1]["rate"] /100 );
            $tax += $secondtaxable   * ($tax_rates_array[2]["rate"] /100); 

            $netsalary = $salary - $tax;
            break;


        case 4:  // over £150,000
                // tax free allowance is 50% of the 10,000
            
            // band 2
            // here we need to include half the tax-free element (£10,000) as they only
            // get 50% of this at this rate.
            // so add half the tax-free element back onto this.
            $firsttaxable =   $tax_rates_array[1]["maxsalary"] - $tax_rates_array[1]["minsalary"] ;
            $firsttaxable += $tax_rates_array[0]["maxsalary"] * ( 50  / 100);
            
            // band 3
            $secondtaxable =   $tax_rates_array[2]["maxsalary"] - $tax_rates_array[2]["minsalary"];

            // band 4
            $thirdtaxable = $salary - $tax_rates_array[2]["maxsalary"];
            
          
            $tax = $firsttaxable * ($tax_rates_array[1]["rate"] /100 );
            $tax += $secondtaxable   * ($tax_rates_array[2]["rate"] /100); 
            $tax += ($thirdtaxable   * ($tax_rates_array[3]["rate"] /100)); 
//            echo "<br>firsttaxtable  = ".$firsttaxable;
//            echo "<br>secondtaxable  = ".$secondtaxable;
//            echo "<br>thirdtaxable  = ".$thirdtaxable;
//            echo "<br>total tax  = ".$tax ." due...<br>";

            $netsalary = $salary - $tax; // temp for testing
        break;
        
        default:
            die("Tax band not found");
    }

    return $netsalary /12;
}

// a loop to work out which band the salary is in.
function getBand($salary){

    if (!isset($salary)) return false;
    if (!is_numeric($salary)) return false;
    echo "Salary =  " . $salary;
    global $tax_rates_array;

    $count = 1;
    foreach ($tax_rates_array as $data) {

        if ( $salary <=  $data["maxsalary"] ) {
    
            return $count; // band (1 - ?)
        }
        
        // TODO - need to trap an error here.
          
        $count++;
    }
} // end getBand()



// quick debug
// terminates script if $terminate set true
function show_array($data, $terminate=TRUE){

    if (empty($data)) return false;

    echo "<pre style='font-weight: bold; color: black; font-size:1em;'>"; 

    print_r($data);
    echo "</pre>";

    if ($terminate) exit;
 

}
?>