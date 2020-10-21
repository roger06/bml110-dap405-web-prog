
<?php
include('fns.php');
include('header.php');

if (!require('incfile-inc.php')) {
    
    echo "can't find include file - script halting";
    // exit();
} 

?>

this includes another file.

<p>The current year is  <?php   print_year(); ?></p>

<?php
include('footer.html');

?>