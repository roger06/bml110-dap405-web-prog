<?php

//hello world as a function
 function hello_world ($name, $age) {
        
      
 


        // return "Hello World..";
        // return $name;
        $name = strtolower($name);

 
        for ($i = 0; $i < $age; $i++) {
            echo "In year " . $i . " ". $name . " was age ". $i ."<br>";

        }
    
    }


$name = 'JOE';
$age = 4;

  // print user name and age
//  hello_world($name, $age);

//  exit;




 for ($i = 0; $i < $age; $i++) {
   hello_world($name, $age);

}



?>
