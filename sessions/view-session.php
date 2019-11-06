
<?php
session_start();
 
echo '<h2>View all</h2>';
// print out everything in the $_SESSION superglobalarray
echo '<pre>';

    print_r($_SESSION);
echo '<pre>';


echo '<h2>Use individually</h2>';

echo 'Hi ' . $_SESSION['name']. '<br>';
echo 'Your email is ' . $_SESSION['email']. '<br>';
echo 'and you are ' . $_SESSION['age']. ' years old.<br>';

echo '<h2>Now let\'s change some details (update age)</h2>';

$_SESSION['age'] = 22;

echo 'Uou are ' . $_SESSION['age']. ' years old.<br>';

?> 
<a href="session-destroy.php">Destroy session and return to first page</a>