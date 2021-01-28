<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
    <header>
        <div class="row bg-primary text-white"> 
            <div class="col-4">
                Sykes Tax Calculator
            </div>
            <div class="col-4">
                List of employees
            </div>
            <div class="col-4">
                <form action="Login.php" method="post" class="pull-right">
                    <input type="submit" value="Logout">
                </form>
            </div>
        </div>
    </header>
    <main>
        <?php
            include("Functions.php");
            $idNumber = $_GET["id"];
    
            $jsonFilePath = "JSON/employees-final.json";
            $jsonEncoded = @file_get_contents($jsonFilePath);
            $jsonDecoded = json_decode($jsonEncoded, true);
            
            foreach($jsonDecoded as $employee)
            {
                if ($employee["id"]==$idNumber)
                {
                    echo "<h2>Payslip for Employee ID: " . $employee["id"] . ", " . $employee["firstname"] . " " . $employee["lastname"] . ".</h2>";
                            
                    echo "<table class='table'>";
                    echo "<tbody>";
                    // Gross Yearly (before tax)
                    echo "<tr>";
                    echo "<th scope='row'>Gross Yearly Pay</th>";
                    echo "<td>" . $employee["salary"] . "</td>";
                    echo "</tr>";
                    // Gross Monthly (before tax)
                    echo "<tr>";
                    echo "<th scope='row'>Gross Monthly Pay</th>";
                    echo "<td>" . round(($employee["salary"] / 12), 2) . "</td>";
                    echo "</tr>";
                    // Net Yearly (after tax)
                    echo "<tr>";
                    echo "<th scope='row'>Net Yearly Pay</th>";
                    echo "<td>" . round(($employee["salary"] - CalculateTaxDeductedYearly($employee)), 2) . "</td>";
                    echo "</tr>";
                    // Net Monthly
                    echo "<tr>";
                    echo "<th scope='row'>Net Monthly Pay</th>";
                    echo "<td>" . round((($employee["salary"] - CalculateTaxDeductedYearly($employee)) / 12), 2) . "</td>";
                    echo "</tr>";
                    // Tax deducted yearly
                    echo "<tr>";
                    echo "<th scope='row'>Yearly Tax Deductions</th>";
                    echo "<td>" . round(CalculateTaxDeductedYearly($employee), 2) . "</td>";
                    echo "</tr>";
                    // Tax deducted monthly
                    echo "<tr>";
                    echo "<th scope='row'>Monthly Tax Deductions</th>";
                    echo "<td>" . round((CalculateTaxDeductedYearly($employee) / 12), 2) . "</td>";
                    echo "</tr>";
                }
            }
        ?>
            </tbody>
        </table>
    </main>
</body>
</html>