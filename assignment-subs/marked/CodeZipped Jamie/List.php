<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sykes Tax Calculator - List of employees</title>

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
            <div class="col-7">
                List of employees
            </div>
            <div class="col-1">
                <form action="Login.php" method="post" class="pull-right">
                    <input type="submit" value="Logout">
                </form>
            </div>
        </div>
    </header>
    <main>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Employee ID</th>
                    <th scope="col">Employee Name</th>
                    <th scope="col">Employee Salary</th>
                    <th scope="col">Employee Take Home (monthly)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include("Functions.php");
    
                    $jsonFilePath = "JSON/employees-final.json";
                    $jsonEncoded = @file_get_contents($jsonFilePath);
                    $jsonDecoded = json_decode($jsonEncoded, true);

                    foreach($jsonDecoded as $employee)
                    {
                        echo "<tr>";
                        echo "<th scope='row'>" . $employee["id"] . "</th>";
                        echo "<td><a href='Employee.php?id=" . $employee["id"] . "'>" . $employee["firstname"] . " " . $employee["lastname"] . "</a></td>";
                        echo "<td>" . $employee["salary"] . "</td>";
                        echo "<td>" . round((($employee["salary"] - CalculateTaxDeductedYearly($employee)) / 12), 2) . "</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>