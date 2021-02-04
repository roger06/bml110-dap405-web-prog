<?php

  session_start();                // start session
  include('functions.php');       // include functions
  $user_type = check_user_type(); // get user type
  require('./fpdf.php');          

  if (isset($_POST['employee'])) {
    $employee = json_decode($_POST['employee']);     // get employee data from POST variable
    $address = explode(',', $employee->homeaddress); // get lines of address of employee
    $gross_pay = number_format($employee->salary, 2).' '.$employee->currency; // 
    $tax = '-'.$employee->tax.' '.$employee->currency;       // 
    $net_pay = $employee->take_home.' '.$employee->currency; //
    
    $pdf = new FPDF(); // create instance of FPDF class
    $pdf->AddPage();   // add page
    $pdf->SetFont('Courier', 'B', '14'); // set font 
    $pdf->Cell(100, 10, $employee->firstname.' '.$employee->lastname); // add employee's first and last name to pdf
    $pdf->Ln(10);      // new line

    $pdf->SetFont('Courier', '', '12'); // set font
    foreach($address as $line) {              // iterate through lines of address
        $pdf->MultiCell(100, 5, trim($line)); // display line
    }

    $pdf->Cell(100, 10, 'Phone: '.$employee->phone);     // add phone number to pdf
    $pdf->Ln(5);                                         // new line
    $pdf->Cell(100, 10, 'Email: '.$employee->homeemail); // add email to pdf
    $pdf->Ln(10);

    $pdf->Cell(50, 10, 'Gross Pay');
    $pdf->Cell(30, 10, $gross_pay, 0, 0, 'R'); // add employee's gross pay to pdf, aligned to the right
    $pdf->Ln(5);                               // new line
    $pdf->Cell(50, 10, 'Tax');
    $pdf->Cell(30, 10, $tax, 0, 0, 'R');       // add employee's tax to pdf, aligned to the right
    $pdf->Ln(5);                               // new line
    $pdf->Cell(50, 10, 'Net Pay');
    $pdf->Cell(30, 10, $net_pay, 0, 0, 'R');   // add employee's net pay to pdf, aligned to the right
    $pdf->Ln(5);                               // new line

    $pdf->Output();                            // output pdf
  } else {
    header('Location: employee_table.php'); // return to home page
  }

?>