<!-- Link header file -->
<?php
require('header.php');
?>
<title>Get an array from JSON file</title>
<link type="text/css" rel="stylesheet" href="table.css" />
<!-- Link to employee JSON file -->
<?php require 'get_array_from_json.php'; ?>
</head>

<!-- Page intro text -->

<body>
    <div class="p-4 p-md-5 mb-4 rounded bg-light">
        <h3>Employee Data</h3>
        <br>
        <p>Please find the employee data in the table below. You can click on an employee's name to generate their payslip where you can then save as a PDF or print.</p>
        <br>
        <?php

        /*Initializing table variable to design table dynamically*/
        $table = "<table>";

        /*Defining table Column headers depending upon JSON records*/
        $table .= "<tr><th>ID</th>";
        $table .= "<th>Name</th>";
        $table .= "<th>Grade</th>";
        $table .= "<th>NI Number</th>";
        $table .= "<th>Department</th>";
        $table .= "<th>Line Manager</th>";
        $table .= "<th>Monthly Salary</th>";
        $table .= "<th>DOB</th>";
        $table .= "<th>Start Date</th>";
        $table .= "<th>Years Employed</th>";
        $table .= "<th>Pension</th>";
        $table .= "<th>Company Car</th>";
        $table .= "<th>Tax Rate</th>";
        $table .= "<th>Salary</th>";
        $table .= "<th>Tax Deducted</th>";
        $table .= "<th>Take Home pay</th></tr>";

        /*Dynamically generating rows & columns*/
        for ($i = 0; $i < sizeof($employees); $i++) {
            $emp = $employees[$i];
            $table .= "<tr>";
            $table .= "<td>" . $emp["id"] . "</td>";
            $table .= "<td>" . "<a href='employeedetails.php?id=" . $i . "'" . ">" . $emp["firstname"] . " " . $emp["lastname"] . "</a></td>";
            $table .= "<td>" . $emp["grade"] . "</td>";
            $table .= "<td>" . $emp["nationalinsurance"] . "</td>";
            $table .= "<td>" . $emp["department"] . "</td>";
            $table .= "<td>" . $emp["linemanager"] . "</td>";
            $table .= "<td>" . get_currency_symbol($emp["currency"]) . number_format(($emp["salary"] / 12), 2) . "</td>";
            $table .= "<td>" . $emp["dob"] . "</td>";
            $table .= "<td>" . $emp["employmentstart"] . "</td>";
            $table .= "<td>" . (intval(date('Y')) - intval(substr($emp["employmentstart"], -4))) . "</td>";
            $table .= "<td>" . $emp["pension"] . "</td>";
            $table .= "<td>" . $emp["companycar"] . "</td>";
            $table .= "<td>" . get_tax_detail_from_salary($emp["salary"], "rate") . "</td>";
            $table .= "<td>" . get_currency_symbol($emp["currency"]) . number_format($emp["salary"], 2) . "</td>";
            $table .= "<td>" . get_currency_symbol($emp["currency"]) . number_format(calculate_tax($emp["salary"], $emp["companycar"], $emp["currency"]), 2) . "</td>";
            $table .= "<td>" . get_currency_symbol($emp["currency"]) . number_format(($emp["salary"] - calculate_tax($emp["salary"], $emp["companycar"], $emp["currency"])), 2) . "</td>";

            $table .= "</tr>";
        }

        /*End tag of table*/
        $table .= "</table>";

        echo $table
        ?>
    </div>

    <!-- Link footer file -->
    <?php
    require('footer.php');
    ?>