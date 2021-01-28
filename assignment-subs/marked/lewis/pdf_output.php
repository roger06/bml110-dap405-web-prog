
<?php
session_start();
$payslip_data = $_SESSION['payslip_data'];

require('fpdf/fpdf.php');
$address = "Address: ". $payslip_data[0];
$first_name = $payslip_data[1];
$last_name = $payslip_data[2];

$jobtitle = "Job Title: " . $payslip_data[3];
$currencysymbol = $payslip_data[4]; //gets symbol from array
$currencysymbol = str_replace("£","%A3",$currencysymbol); //sets £ symbol to equal it's ascii equvilent 
$currencysymbol = urldecode($currencysymbol); //converts it into correct format 


$monthly_salary_rounded = "Monthly Net Pay: " . $currencysymbol . $payslip_data[5];
$monthly_tax_rounded = "Monthly Tax: " . $currencysymbol . $payslip_data[6];
$salary = "Yearly Salary Before Tax: " . $currencysymbol . $payslip_data[7];
$companycar = "Company car y/n: " . $payslip_data[8];
$ni_number =  "NI Number: " . $payslip_data[9];

$name = "Name: " . $first_name . " " . $last_name;


$data = "test";
$pdf=new FPDF('P','mm','A4');//creates a cell for each bit of infomation 
$pdf->AddPage();
$pdf->SetFont('Arial','B',28);

$pdf->Cell(10,10,"",0,1,'C');//c centers the text and 0 applies to underline, next 1 causes the next cell to be on a new line 

$pdf->Cell(20,10,"      Payslip",0,1,'C');

$pdf->SetFont('Arial','B',14);


$pdf->Cell(25,10,$name ,0,1);

$pdf->Cell(30,10,$address,0,1);

$pdf->Cell(35,10,$jobtitle,0,1);

$pdf->Cell(45,10,$salary,0,1);

$pdf->Cell(55,10,$companycar,0,1);

$pdf->Cell(65,10,$ni_number,0,1);

$pdf->Cell(75,10,$monthly_salary_rounded ,0,1);

$pdf->Cell(85,10,$monthly_tax_rounded,0,1);



$pdf->output();



unset($_SESSION['payslip_date']);

?>
