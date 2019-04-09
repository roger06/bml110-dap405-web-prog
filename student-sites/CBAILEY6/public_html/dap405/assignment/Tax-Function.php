<?php
function TaxCalc($salary) { //Define a function called JSON which will bring the json file in and decode it into a php array.

    echo 'TaxCalc for salary = '.$salary .'<p>';

    $fileget = file_get_contents("./tax-tables.json"); //Obtaining JSON file of Tax values.
    $taxarray = json_decode($fileget, true); //Decoding into a PHP array.
    $TotalTax = 0;
//    echo '<pre>';     print_r($taxarray);     echo '</pre>';





    foreach ($taxarray as $taxbands) { //Foreach loop to loop through the bands in the tax salary.

//          echo 'taxband  minsalary= '.$taxbands["minsalary"] .'<p>';

        if ($salary > $taxbands["minsalary"]) { //if salary alrger than minsalary,
//               echo 'salary larger than = '.$taxbands["minsalary"] .'<p>';

            if ($salary < $taxbands["maxsalary"]) { //and if the salary is smaller than the taxbands maximum,
                $BandTax = $salary - $taxbands["minsalary"]; //Minus the minsalary tax band from the salary.
            }

            else {
                $BandTax = $taxbands["maxsalary"] - $taxbands["minsalary"]; //Else if the salary is larger take the maximum band from the minimum.
//                 echo '<p><b> this is our tax band = '.$BandTax.'</b><p>';
            }
//
//             echo '<h1>  tax band = '.$BandTax.'</b></h1>';
//             echo '<h2>  tax rate = '.$taxbands["rate"] .'</b></h2>';
//             echo '<h2>  tax rate name = '.$taxbands["name"] .'</b></h2>';
//            echo '<h2>  tax calc = '.$BandTax .' * '.$taxbands["rate"].' / 100 </b></h2>';
            $Taxcost = $BandTax * ($taxbands["rate"] / 100); //Total the cost of the tax by taking the determined Tax Band and multiple the rate by 100 to find the percentage of tax.
            $TotalTax+= $Taxcost;
//                         echo '<h2> total tax = '.$TotalTax .'</b></h2>';
//                         echo '<h2> month total tax = '.$TotalTax / 12 .'</b></h2>';

        }
    }
    return $TotalTax / 12;
}
?>
