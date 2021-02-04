<?php
    function CalculateTaxDeductedYearly($employee)
    {
        // Decode tax tables json to array
        $taxFilePath = "JSON/tax-tables.json";
        $taxEncoded = @file_get_contents($taxFilePath);
        $taxDecoded = json_decode($taxEncoded, true);

        // Get employee info and initialise tracker variables
        $salary = $employee["salary"];
        $companyCar = $employee["companycar"];
        $currency = $employee["currency"];
        $takeHomeMonthly = 0;
        $totalDeducted = 0;
        $newSalary = $salary;

        // Only pay tax if currency is GBP, otherwise it is assumed payed in home country
        if ($currency=="GBP")
        {
            // If company car or salary greater than 150k, tax at 20% of band 1.
            if (($companyCar=="y") || ($salary > 150000))
            {
                $taxDeducted = ($taxDecoded[0]["maxsalary"] / 100 ) * 20;
                $totalDeducted += $taxDeducted;
            }
            
            // For each band, apply tax
            foreach($taxDecoded as $taxBand)
            {
                // If salary above max salary, remove that bands max salary taxed
                // Otherwise remove it from remaining salary (this will be last tax band applied)
                if ($newSalary>=$taxBand["maxsalary"])
                {
                    $taxDeducted = ($taxBand["maxsalary"] / 100 ) * $taxBand["rate"];  

                    // Deduct it from salary for next loop, also keep track of tax deducted
                    $newSalary = $newSalary - $taxBand["maxsalary"];
                    $totalDeducted += $taxDeducted;
                }
                else
                {
                    $taxDeducted = ($newSalary / 100 ) * $taxBand["rate"];

                    // Deduct it from salary for next loop, also keep track of tax deducted
                    $newSalary = $newSalary - $newSalary;
                    $totalDeducted += $taxDeducted;
                }
            }
            
            return $totalDeducted;
        }
        else 
        {
            // If currency is not GBP then they are not taxed (assumed done in home country)
            return 0;
        }
    }


?>