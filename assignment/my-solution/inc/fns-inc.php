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
        $row .= "&pound";
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


// function format($data, $type){

//     if($type == "GBP") $data = "&pound" . number_format($data,2);
//     return $data;

// }



?>