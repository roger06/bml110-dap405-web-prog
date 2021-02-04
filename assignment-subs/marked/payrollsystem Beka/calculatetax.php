<!-- Link header file -->
<?php
require('header.php');

// Link to employee JSON file
include 'get_array_from_json.php'; ?>
<title>Employee Calculation</title>
</head>

<!-- Page intro text -->

<body>
    <br>
    <main class="container">
        <h3 class="pb-4 mb-4 border-bottom">
            Tax Calculation
        </h3>
        <p>
            Please find your tax calculation below.
        </p>

        <!-- Start of tax calulation result response -->
        <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
            <?php
            if (isset($_POST['GBP']) && $_POST["GBP"] == "y") {

                if (isset($_POST['compCar']) && $_POST["compCar"] == "y") {
                    echo 'For the salary £' . $_POST['salary'] . ' with a company car you will pay £' . calculate_tax($_POST['salary'], "y", "GBP") . ' in taxes.';
                } else {
                    echo 'For the salary £' . $_POST['salary'] . ' without a company car you will pay £' . calculate_tax($_POST['salary'], "n", "GBP") . ' in taxes.';
                }
            } else {
                echo 'As your salary is not paid in GBP you will not pay tax as it is assumed you will pay taxes in your home country.';
            }

            ?>
        </div>
        </div>

        <!-- Button to return to previous page - tax calculation form -->
        <div class="btn-group">
            <a href="calculatetaxpage.php" class="btn btn-sm btn-outline-secondary">Calculate New Tax</a>
        </div>
        
        <!-- Link footer file -->
        <?php
        require('footer.php');
        ?>