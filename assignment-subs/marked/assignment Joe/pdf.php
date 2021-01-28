<?php
#https://www.siteground.com/kb/how_to_generate_pdf_files_with_php/

#C:\xampp\php\pear\fpdf must have the includes downloaded
require('fpdf/fpdf.php');
include('payroll_function.php');
session_start();
#Calculate current tax year pay
function getPayMonth(){
    $tax_reset = 4; #April is tax year reset
    $current_month = date("m");
    if ($current_month >= $tax_reset){
        $tax_month = $current_month - $tax_reset;
        }
    else{
        $tax_month = (12 - $tax_reset) + $current_month;
    }
    return $tax_month;
}

#Uses config file to handle number rounding. config is setup to round everything down to 2 decimal places
function roundPenny($amount){
    $round_down_penny = true;
    if ($round_down_penny){
    #https://www.w3schools.com/php/func_math_floor.asp
        $amount = floor($amount*100)/100;
    }
    else{
        $amount = ceil($amount*100)/100;
    }

    return $amount;
}


function phpGen($person, $deductions){
    $pdf = new fpdf();
    $pdf->SetTitle("Pay roll");
    $pdf->AddPage();

    $pdf->SetFont('Arial', '', 12);
    #write name and address
    $name_and_addr = $person['firstname'] . $person['lastname'];
    $addr = explode(', ', $person['homeaddress']);
    foreach($addr as $line){
        $name_and_addr = $name_and_addr . "\n\n" . $line;
    }
    $name_and_addr = $name_and_addr . "\n\n" . $person['nationalinsurance'];
    $pdf->MultiCell(0,3,$name_and_addr);
    $pdf->Ln(5);

    $pdf -> Cell(0,2, ("Tax month - " . getPayMonth()), 0, 1, "C");
    $pdf->Ln(10);
    #write earnings section
    $pdf->SetFont('Arial', 'B', 14);
    $pdf -> Cell(0,0, "\nEarnings:");
    $pdf->SetFont('Arial', '', 12);
    $pdf -> Ln(3);

    $earnings = ("Salary: " . roundPenny(($person['salary'])/12) .
        "\n\nSalary Sacrifice(Pension): " . roundPenny(($deductions['pension']["employee_contrib"])) .
        "\n\nTotal: " . roundPenny((($person['salary'])/12) - ($deductions['pension']["employee_contrib"]))
        );
    $pdf -> Ln();
    $pdf ->MultiCell(0,6,$earnings, 1);
    $pdf -> Ln(9);
    #write deductions section
    $payroll_deduction = ("\nTax: " . ($deductions['tax']));
    $pdf->SetFont('Arial', 'B', 14);
    $pdf -> Cell(0,0,"Deductions:");
    $pdf ->SetFont('Arial', '', 12);
    $pdf -> Ln(3);
    $pdf -> Cell(0, 5, $payroll_deduction, 1);

    #write earnings section to pdf
    $pdf -> Ln(12);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf -> Cell(0,0,"Amount paid:");
    $pdf ->SetFont('Arial', '', 12);
    $pdf -> Ln(3);
    $earnings = ("Earnings: " . roundPenny(($person['salary'])/12) . 
    "       Deductions: " . roundPenny($deductions['tax']/12) . "\n\n
    Net pay: " . roundPenny($deductions['net']/12) . "\n\n\n\n
    Amount paid: " . roundPenny($deductions['net']/12));

    $pdf -> Cell(0, 6, $earnings, 1);

    $pdf -> Ln(13);
    #Write pension section to pdf
    $pension = ("Monthly contributions: \n
Employee contribution: " . roundPenny($deductions['pension']['employee_contrib']) . "\n
Employer contribution: " . roundPenny($deductions['pension']['employer_contrib']));
    $pdf -> SetFont('Arial', 'B', 14);
    $pdf -> Cell(0,0,"Pension:");
    $pdf -> SetFont('Arial', '', 12);
    $pdf -> Ln(3);
    $pdf -> MultiCell(0, 6, $pension, 1);
    $pdf -> Ln(8);
    $pdf -> SetFont('Arial', '', 14);
    $pdf -> Cell(0, 0, "Annual salary: " . $person['salary']);
    $pdf->Output();
}

#Opens a new tab and calls phpGen function from pdf.php to draw a PDF and output to screen
function displayPDF($person, $tax_json){
    phpGen($person, calcPayCheque($person, $tax_json));
}
if ($_POST){

    if(isset($_POST['advanced'])) {
        echo "<pre>";
        print_r($_SESSION['employee_json'][intval($_POST['advanced'])]);
        echo "</pre>";
    }
    elseif(isset($_POST['payroll'])){

        if(isset($_SESSION['employee_json']) and isset($_SESSION['tax_json'])){
            echo
            displayPDF($_SESSION['employee_json'][intval($_POST['payroll'])], $_SESSION['tax_json']);
        }
    }
}


?>