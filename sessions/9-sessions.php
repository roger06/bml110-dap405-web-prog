<html>
    <head>

    <title>session test</title>
    </head>
    <body>
        <h1>Session test</h1>


<?php
 echo ('h1 <p>');

$name = 'bill';

session_start();
    $_SESSION['name'] = 'roger';
    $_SESSION['age'] = 21;
//sessions

    echo 'name = ' .$_SESSION['name'] ;
    echo '<p>age = ' . $_SESSION['age']  ;
?>
<h2>Cookie?</h2>
<?php    print_r($_COOKIE);

?>
        </body>
</html>
