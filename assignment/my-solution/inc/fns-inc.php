<?php

// functions

set_error_handler(
    function ($severity, $message, $file, $line) {
        throw new ErrorException($message, $severity, $severity, $file, $line);
    }
);


function write_cell($data, $format=''){

    // echo "fn called .data = " . $data;

    if (!isset($data)) {

        echo "no cell data!";
        exit;
    }

    $row = "<td>". format($data, $format) . "</td>";
    return $row;


} // end function write_cell


function format($data, $type){

    if($type == "GBP") $data = "&pound" . number_format($data,2);
    return $data;

}



?>