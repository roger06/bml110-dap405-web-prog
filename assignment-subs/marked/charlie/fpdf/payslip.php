<?php
#####################################
#Generates a payslip PDF			#
#Too self-explanatory to comment	#
#####################################
session_start();
require "../tax_calculator.php";
require 'fpdf.php';//This is calling out to an external file from fpdf.org and is not my own, it is used to generate PDFs.

class PDF extends FPDF
{
// Page header
function Header()
{
	// Logo
	$this->SetFont('courier',"",16);
	$this->Image('logo.png',10,10,100);
	$this->Ln(40);
}

// Page footer
function Footer()
{
	// Position at 1.5 cm from bottom
	$this->SetY(-15);
	// Arial italic 8
	$this->SetFont('Arial','I',8);
	// Page number
	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

function Address(&$pdf){
	$pdf->SetFont("Arial", '', 11);
	$fullname = " ".$_SESSION["user"]["firstname"]." ".$_SESSION["user"]["lastname"];
	$address = explode(",", $_SESSION["user"]["homeaddress"]);
	$formattedString = $fullname.":\n ".implode(",\n", $address);
	$lines = count(explode("\n", $formattedString));

	$pdf->MultiCell(100, 6, $formattedString, 1);
}

function Message(&$pdf){
	$pdf->MultiCell(190, 6, "For support, email: support@acme.com or dial 999", 1, "L");
	$pdf->Ln(4);
}

function Details(&$pdf){
	$pdf->SetFont('courier','B',12);
	$pdf->Cell(3, 6, "ID: ", "TBL", 0, "L");
	$pdf->SetFont('courier','',12);
	$pdf->Cell(22, 6, $_SESSION["user"]["id"], "TBR", 0, "R");
	
	$pdf->SetFont('courier','B',12);
	$pdf->Cell(20, 6, "Name:", "TBL", 0);
	$pdf->SetFont('courier','',12);
	$pdf->Cell(100, 6, $_SESSION["user"]["firstname"]." ".$_SESSION["user"]["lastname"], "TBR", 0, "R");

	$pdf->SetFont('courier','B',12);
	$pdf->Cell(5, 6, "NI:", "TBL", 0);
	$pdf->SetFont('courier','',12);
	$pdf->Cell(40, 6, $_SESSION["user"]["nationalinsurance"], "TBR", 0, "R");
	
	
	$pdf->Ln(10);
	
	$pdf->SetFont('courier','B',12);
	$pdf->Cell(25, 6, "ACME Corp", 1, 0, "R");
	
	$pdf->SetFont('courier','B',12);
	$pdf->Cell(30, 6, "Pay Date:", "TBL", 0);
	$pdf->SetFont('courier','',12);
	$pdf->Cell(90, 6, date("j-n-Y", strtotime("last day of previous month")), "TBR", 0, "R");
	
	$pdf->SetFont('courier','B',12);
	$pdf->Cell(40, 6, "Tax Month:", "TBL", 0);
	$pdf->SetFont('courier','',12);
	$pdf->Cell(5, 6, TaxMonth(), "TBR", 0, "R");
	$pdf->Ln(7);
}
function AnnualBreakdown(&$pdf){
	$currencysymbols = ["GBP"=>chr(163), "EUR"=>chr(128), "USD"=>chr(36), "YEN"=>chr(165)];
	$currency = $currencysymbols[$_SESSION["user"]["currency"]];
	
	$pdf->ln(5);
	
	$pdf->SetTextColor(69,68,90);
	$pdf->SetFont("Arial", "B", 20);
	$pdf->Cell(190, 15, "ANNUAL SUMMARY", 0, 1, "L");
	$pdf->SetTextColor(0,0,0);

	
	$pdf->SetFont("courier", "B", 12);
	$pdf->Cell(25,6, "Salary: ", "TBL");
	$pdf->SetFont("courier", "", 12);
	$pdf->Cell(25,6, $currency.number_format($_SESSION["user"]["salary"]), "TBR", 0, "R");

	$pdf->SetFont("courier", "B", 12);
	$pdf->Cell(25,6, "Tax: ", "TBL");
	$pdf->SetFont("courier", "", 12);
	$pdf->Cell(25,6, $currency.number_format(CalculateTaxTotal($_SESSION["user"])), "TBR", 0, "R");

	$pdf->SetFont("courier", "B", 12);
	$pdf->Cell(25,6, "Take Home: ", "TBL");
	$pdf->SetFont("courier", "", 12);
	$pdf->Cell(25,6, $currency.number_format(CalculateAfterTax($_SESSION["user"])), "TBR", 0, "R");
	
	$pdf->SetFont("courier", "B", 12);
	$pdf->Cell(25,6, "Car: ", "TBL");
	$pdf->SetFont("courier", "", 12);
	$pdf->Cell(15,6, $_SESSION["user"]["companycar"], "TBR");
	$pdf->ln(12);
}

function MonthlyBreakdown(&$pdf){
	$currencysymbols = ["GBP"=>chr(163), "EUR"=>chr(128), "USD"=>chr(36), "YEN"=>chr(165)];
	$currency = $currencysymbols[$_SESSION["user"]["currency"]];
	$message = "Full Tax-Free Allowance";
	if($_SESSION["user"]["salary"] >= 150000){ $message = " Annually over ".$currency."150,000.00 Tax-Free Amount Halved"; }
	if($_SESSION["user"]["companycar"] == "y"){ $message = "Company car. Tax-Free Amount Halved"; } 

	$pdf->SetFont('arial', 'B', 20);

	$pdf->SetTextColor(69,68,90);
	$pdf->Cell(190, 15, "MONTHLY BREAKDOWN", 0, 1, "L");
	$pdf->SetTextColor(0,0,0);

	$pdf->SetFont("Arial", "B", 12);
	$pdf->Cell(80, 6, "Bracket", 1, 0, "C");
	$pdf->Cell(20, 6, "Rate", 1, 0, "C");
	$pdf->Cell(45, 6, "Paid", 1, 0, "C");
	$pdf->Cell(45, 6, "Remaining", 1, 1, "C");

	$pdf->SetFont("courier", "", 12);
	$pdf->Cell(145, 6, $message, 1);
	$pdf->Cell(45, 6, $currency.number_format($_SESSION["user"]["salary"]/12, 2), 1, 1, "R");

	$taxArray = CalculateAndGetBrackets($_SESSION["user"]);
	foreach($taxArray as $key => $bracket){
		$pdf->Cell(80, 6, $currency.number_format($bracket["min"]/12, 0)."-".$currency.number_format($bracket["max"]/12, 0), "LR");
		$pdf->Cell(20, 6, "%".$bracket["rate"], "LR", 0, "R");
		$pdf->Cell(45, 6, $currency.number_format($bracket["paid"]/12, 2), "LR", 0, "R");
		$pdf->Cell(45, 6, $currency.number_format($bracket["remaining"]/12, 2), "LR", 1, "R");
	}

	
	$pdf->SetTextColor(69,68,90);
	$pdf->setFont("Arial", "B", 20);
	$pdf->Cell(190, 15, "MONTHLY TOTALS", "T", 1, "L");
	$pdf->SetTextColor(0,0,0);

	
	$pdf->SetFont("courier", "", 12);
	$pdf->Cell(80, 6, "", 0, 0);
	$pdf->Cell(20, 6, "%".number_format(CalculateMonthlyTax($_SESSION["user"])*(100/($_SESSION["user"]["salary"]/12))), 1, 0, "R");
	$pdf->Cell(45, 6, $currency.number_format(CalculateMonthlyTax($_SESSION["user"]), 2), 1, 0, "R");
	$pdf->Cell(45, 6, $currency.number_format(CalculateMonthlyTakeHome($_SESSION["user"]), 2), 1, 0, "R");
}

$pdf = new PDF();
$pdf->SetDrawColor(66, 68, 90);	
$pdf->AliasNbPages();
$pdf->AddPage();

Address($pdf);
$pdf->SetFont('arial', 'B', 20);

$pdf->SetTextColor(69,68,90);
$pdf->Cell(100, 20, "PRIVATE & CONFIDENTIAL", 0, 1, "C");
$pdf->SetTextColor(0,0,0);

$pdf->SetFont('courier', '', 12);
Message($pdf);
Details($pdf);
AnnualBreakdown($pdf);
MonthlyBreakdown($pdf);
$pdf->Output();
?>