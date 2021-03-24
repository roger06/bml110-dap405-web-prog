<html>
    <head>

    <title>session test</title>
    </head>
    <body>
        <h1>Session test</h1>


<?php
        
session_start();
 



    $_SESSION['name'] = 'Dan';
    $_SESSION['age'] = 21;
    $_SESSION['mail'] = 'asd@com';
    $_SESSION['address'] = '1 The Avenue';
    $_SESSION['mates'] =array('Jon','Mary','Bob');
//sessions

    echo 'Session name = ' .$_SESSION['name'] ;
    echo '<p>Session  age = ' . $_SESSION['age']  ;
    echo '<p>Session  age = ' . $_SESSION['address']  ;
?>
<h2>Iterate through $_SESSION</h2>
    
 <pre>
<?php    print_r($_SESSION);

?>
</pre>      

<hr>    
        
<h2>Cookie</h2>
<pre>
<?php    print_r($_COOKIE);

?>
</pre>
<h2>Navigate to a second file</h2>   

<p><a href="sessions2.php">Another file.</a></p>    
        
        
        
        
    
    </body>
</html>
