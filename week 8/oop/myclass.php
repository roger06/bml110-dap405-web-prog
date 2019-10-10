<?php

///////////////   define class /////////////////////////

class MyClass {
    
    
    public $name = 'Barry';
    
    
    public function echoName() {
        
        echo $this->name;
        
        
    } // end function 
    
    
    
} // end MyClass



///////////////   instantiate object /////////////////////////


    $myObject = new MyClass();


    echo $myObject->echoName();


    echo $myObject->name;

?>