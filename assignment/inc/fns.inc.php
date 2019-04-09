<?php
//PHP functions


function validate_json() {


    switch (json_last_error()) {
            case JSON_ERROR_NONE:
                return;
            break;
            case JSON_ERROR_DEPTH:
                return ' - Maximum stack depth exceeded';
            break;
            case JSON_ERROR_STATE_MISMATCH:
                return ' - Underflow or the modes mismatch';
            break;
            case JSON_ERROR_CTRL_CHAR:
                return ' - Unexpected control character found';
            break;
            case JSON_ERROR_SYNTAX:
                return ' - Syntax error, malformed JSON';
            break;
            case JSON_ERROR_UTF8:
                return ' - Malformed UTF-8 characters, possibly incorrectly encoded';
            break;
            default:
                return ' - Unknown error';
            break;
    }

} // end validate_json


function format_number($number, $format){

    global $currency_symbol;

    if (!$number) return false;

    if ($format) $format = $currency_symbol[$format];

    $number = number_format($number, 2);
    return   $format.$number;

}


?>
