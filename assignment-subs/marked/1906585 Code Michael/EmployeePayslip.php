<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <style>
        .h3{
            text-align: center !important;
        }
        .container{
			width:80%;
			margin:auto;
			text-align: center;
		}
    </style>
</head>

<body>
    <?php
    require_once('Menu.php');
    require_once('Functions.php');
    ?>
    <div class="container">
        <form id="form1" method="GET">
            <!--method="POST" action=""-->
            <?php
            if(!isset($_SESSION)){
                session_start();
            }
            if (!isset($_SESSION['Login'])) {
                echo "<br><br>Sorry the session has expired.<br><br><br><br>";
                echo "<a type='button' class='btn btn-outline-danger' href='login.php' >Return To Login Page</a>";
                die();
            }
            //Delcare Varaibles first for the Payslip Page

            $UserID = $_GET['UserID'];
            //echo $UserID;
            $UserArray = GetUserArray($UserID);
            if (empty($UserArray)){
                die("<br><p style='text-align:center;'>Sorry an error has occurred in trying to
                     receive that Employee. Please Try again</p><br><br>
                     <a type='button' class='btn btn-outline-danger' href='homePage.php' >Return To Home Page</a>");
            }

            $FirstName = $UserArray['firstname'];
            $LastName = $UserArray['lastname'];
            $JobTitle = $UserArray['jobtitle'];
            $NationalInsurance = $UserArray['nationalinsurance'];
            $Department = $UserArray['department'];
            $Salary = $UserArray['salary'];
            $Currency = $UserArray['currency'];
            $PhoneNum = $UserArray['phone'];
            $EmpEmail = $UserArray['email'];
            $HomeEmail = $UserArray['homeemail'];
            $HomeAddress = $UserArray['homeaddress'];
            $EmploymentStartDate = $UserArray['employmentstart'];
            $EmploymentEndDate = $UserArray['employmentend'];
            $DOB = $UserArray['dob'];
            $Pension = $UserArray['pension'];
            $CompanyCar = $UserArray['companycar'];
            


            if ($Currency == "USD"){
                $Salary *= 0.75; //As Of 11/11/2020
            }

            $SalAfterTax = CalculateTax($Salary, $CompanyCar);
            $TaxPaid = $Salary - $SalAfterTax;
            
            
            if ($Currency == "USD"){
                $Salary *= 1.33; //As of 11/11/2020
                $SalAfterTax *= 1.33; //As of 11/11/2020
                $TaxPaid *= 1.33; //As of 11/11/2020
            }
            //Converts company car
            switch ($CompanyCar){
                case 'y':
                    $CompanyCar = 'Yes';
                break;
                case 'n';
                    $CompanyCar = 'No';
                break;
            }

            switch ($Pension){
                case 'y':
                    $Pension = 'Yes';
                break;
                case 'n':
                    $Pension = 'No';
                break;
            }

            ?>
            <h3 class="h3 display-4" style="margin-bottom:2.5%;">Payslip for employee: <?php echo "$FirstName $LastName"; ?></h3>
            <p style="padding-left:2em;">
            <?php
            //Echos out each line of the address
                $HomeAddressExploded = explode(",", $HomeAddress);
                echo "<p style='text-align:left !important; margin-left:4%;'>";
                foreach ($HomeAddressExploded as $Key => $Val){
                    echo "$Val <br>";
                }
                echo $PhoneNum;
                echo "</p>";
                echo "Dear $FirstName $LastName,<br><br>";//Displays Employee Name
                echo "(Coming soon) Below is a table of your current employment information.<br>If you would like to export this page as a PDF form see below.<br><br>";
                if (!$Department == ""){
                    echo "<strong>Department:</strong> $Department<br>";//Displays department
                }
                echo "<strong>Job Title:</strong> $JobTitle<br>";//Displays Job Title
                echo "<strong>National Insurance Number:</strong> $NationalInsurance<br>";//Displays national insurance
                echo "<strong>Home Email:</strong> $HomeEmail<br>";//Displays Home email
                echo "<strong>Work Email:</strong> $EmpEmail<br>";//Displays Work Email
                echo "<strong>Company Car:</strong> $CompanyCar<br>";//Shows if they have a company car
                echo "<strong>Date Of Birth:</strong> $DOB<br>";//Displays Date Of Birth
                echo "<strong>Enrolled In Pension Scheme:</strong> $Pension<br>";//Displays if they are enrolled in a pension Scheme
                echo "<strong>Paid In:</strong> $Currency<br>";//Shows what currency they are paid in
            ?>
            </p>
            <br>
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <td>
                        Annual Salary
                    </td>
                    <td>
                        Annual Salary After Tax
                    </td>
                    <td>
                        Monthly Income
                    </td>
                    <td>
                        Monthly Income after Tax
                    </td>
                    <td>
                        Annual Tax Paid
                    </td>
                    <td>
                        Monthly Tax Paid
                    </td>
                    <!-- <td>
                        Predicted Income Next Year
                    </td>
                    <td>
                        Predicted Tax Next Year
                    </td> -->
                </thead>
                <tr>
                    <td>
                        <?php echo "&pound;".number_format($Salary,2);//Annual Salary?>
                    </td>
                    <td>
                        <?php
                            //$SalAfterTax = CalculateTax($Salary, $CompanyCar);
                            echo "&pound;".number_format($SalAfterTax, 2);//Annual Salary After Tax;
                            //$SalAfterTax = $Salary - $Salary;
                        ?>
                    </td>
                    <td>
                        <?php
                            echo "&pound;".number_format(($Salary/12), 2);//Monthly Income
                        ?>
                    </td>
                    <td>
                        <?php
                            echo "&pound;".number_format(($SalAfterTax/12),2);//Monthly Income After Tax
                        ?>
                    </td>
                    <td>
                        <?php
                            //$TaxPaid = $Salary - $SalAfterTax;
                            echo "&pound;".number_format($TaxPaid, 2);//Annual Tax Paid
                        ?>
                    </td>
                    <td>
                        <?php
                            echo "&pound;".number_format(($TaxPaid/12),2);//Monthly Tax Paid
                        ?>
                    </td>
                </tr>
            </table>
            <br>
            <a class="btn btn-success" href="homePage.php">Back</a>
        </form>
    </div>
</body>
</html>