<!-- Link header file -->
<?php
require('header.php');
?>

<br>
<!-- Page intro text -->
<main class="container">
    <h3 class="pb-4 mb-4 border-bottom">
        Generate Payslips
    </h3>
    <p>
        You can use the button below to generate PDF payslips for all employees.
    </p>

    <!-- Button to generate payslips for all employees -->
    <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
        <div class="col-md-6 px-0">
            <a class="btn btn-sm btn-outline-light" href="allemployeedetails.php" target="_blank">Generate PDF</a>
        </div>
    </div>

    <!-- Link footer file -->
    <?php
    require('footer.php');
    ?>