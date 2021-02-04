<!-- Link header file -->
<?php
require('header.php');
?>
<title>All Employee Details</title>

<!-- Link to employee JSON file -->
<?php require 'get_array_from_json.php'; ?>
<link type="text/css" rel="stylesheet" href="empdetails.css" />
</head>

<!-- Code to format payslips for all employees and include data from JSON file -->

<body>
        <div id="content">
                <?php
                for ($i = 0; $i < sizeof($employees); $i++) {


                        $emp = $employees[$i];
                        $table = "<table id = \"employee_details\">";

                        $table .= "<tr><th>Employee ID</th>";
                        $table .= "<th>Employee</th>";
                        $table .= "<th>Date</th>";
                        $table .= "<th>NI Number</th></tr>";

                        $table .= "<tr>";
                        $table .= "<td>" . $emp["id"] . "</td>";
                        $table .= "<td>" . $emp["firstname"] . " " . $emp["lastname"] . "</td>";
                        $table .= "<td>" . date("d M Y") . "</td>";
                        $table .= "<td>" . $emp["nationalinsurance"] . "</td>";
                        $table .= "</tr>";

                        $table .= "<tr><th colspan=\"2\">Payments</th>";
                        $table .= "<th colspan=\"2\">Deductions</th></tr>";

                        $table .= "<tr>";
                        //Convert and format salary to float value and store in variable
                        $salary = floatval($emp["salary"] / 12);
                        $table .= "<td colspan=\"2\"><br>Basic Pay:\t\t" . get_currency_symbol($emp["currency"]) . number_format($salary, 2) .
                                "<br><br><strong>Total Pay:\t\t" . get_currency_symbol($emp["currency"]) . number_format($salary, 2) .
                                "</strong><br></td>";

                        $tax = floatval(calculate_tax($emp["salary"], $emp["companycar"], $emp["currency"]) / 12);
                        $table .= "<td id=\"right_align\" colspan=\"2\"><br>Tax:\t\t" . get_currency_symbol($emp["currency"]) . number_format($tax, 2) .
                                "<br><br><strong>Total Deductions:\t\t" . get_currency_symbol($emp["currency"]) . number_format($tax, 2) .
                                "</strong><br></td>";

                        $table .= "</tr>";

                        $table .= "<tr>";

                        $table .= "<td colspan=\"4\"> </td>";

                        $table .= "</tr>";

                        $table .= "<tr><th colspan=\"2\">Address</th>";
                        $table .= "<th> </th>";
                        $table .= "<th>Total - Year To Date</th></tr>";

                        $table .= "<tr><td id=\"left_align\" colspan=\"2\">" . format_address($emp["homeaddress"]) . "</td>";

                        $months = date_diff(date_create(get_last_april()), date_create(date("Y-m-d")))->format("%m");
                        $YTDPay = number_format(($emp["salary"] / 12) * $months, 2);
                        $YTDTax = number_format((calculate_tax($emp["salary"], $emp["companycar"], $emp["currency"]) / 12) * $months, 2);

                        $table .= "<td id=\"right_align\" colspan=\"2\">" . "Taxable Pay: " . get_currency_symbol($emp["currency"]) . $YTDPay . "<br>" .
                                "Tax: " . get_currency_symbol($emp["currency"]) . $YTDTax . "</td></tr>";

                        $table .= "<tr><th id = \"right_align\" colspan=\"4\"><strong>Net Pay</strong></th></tr>";


                        $net_pay = (floatval($salary)) - (floatval($tax));
                        $table .= "<tr><td id = \"right_align\" colspan=\"4\"><strong>" . get_currency_symbol($emp["currency"]) . number_format($net_pay, 2) . "</strong></td></tr>";

                        $table .= "</table>";
                        echo $table;
                }
                ?>
        </div>
        <!-- End of code to format payslip and include data from JSON file -->

        <!-- Button to generate window print file -->
        <div id="print">
                <br>
                <a class="btn btn-sm btn-outline-light" id="print-button" onclick="window.print();return false;">Print / Save Payslip</a>
        </div>

        <!-- Button to return to previous page - generate payslips for all employees -->
        <div class="btn-group">
                <a href="generate_pdf.php" class="btn btn-sm btn-outline-secondary">Back to Generate</a>
        </div>

        <!-- Link footer file -->
        <?php
        require('footer.php');
        ?>