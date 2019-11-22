<?php

function is_ajax_request(){
    
    
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        $_SERVER['HTTP_X_REQUESTED_WITH'] =='XMLHtpRequest';
 }


if (is_ajax_request()){
    
    echo "AJAX response"
}

else echo "NON AJAX response";



?>