
<?php
session_start();

$student = array('name' => 'Nicoletta', 'age' => 21,  'username' => 'Nicol2',  'email' => 'Nicoletta@email.com' );


foreach ($student as $key => $value){
    
    echo $key . " " . $value . "<br>";
    $_SESSION[$key] = $value;

}

?> 
<a href="view-session.php">View sessions on next page</a>