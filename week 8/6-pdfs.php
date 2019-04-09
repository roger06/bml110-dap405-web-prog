<?php

 
// PDFs
// not sure we'll do this...

require('../fpdf/fpdf.php');
//http://www.fpdf.org/


$jsonfile = '../week6/payroll-final2.json';

$json = file_get_contents($jsonfile) or die("cannot open file");
$json_data = json_decode($json, true);
//echo '<pre>';
//print_r($json_data);
//echo '</pre>';
//exit;

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Employee data');

foreach($json_data[0] as $data)
{
    
    $pdf->Cell(0,10, $data,0,1);
}

$pdf->Output();



    
?>
