<?php

 
// PDFs
// not sure we'll do this...

require('../fpdf/fpdf.php');
//http://www.fpdf.org/

$pdfdata = array('one', 'two', 'three');
 
//$pdf = new FPDF();
$pdf = new FPDF('P', 'in', 'Letter');
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
//$pdf->Cell(4,10,'This is the title');
// .       w, h,  txt,  

$pdf->Cell(0,0,'Top left...',0,1,'L');
// .       w, h,  txt,                                                      border



$pdf->Cell(6,0.5,'Top right', 1, 0 , 'R');
// .       w, h,  txt,                                                      border


$pdf->ln(4.5);


$pdf->Cell(0,0,'middle', 0, 0 , 'C');



$pdf->ln(5);
$pdf->Cell(0,0,'bottom left', 0, 0 , 'L');
$pdf->Cell(0,0,'bottom right', 0, 0 , 'R');

//foreach($pdfdata as $data)
//{
//    
//    $pdf->Cell(0,10, $data,0,1);
//}

$pdf->Output();



    
?>
