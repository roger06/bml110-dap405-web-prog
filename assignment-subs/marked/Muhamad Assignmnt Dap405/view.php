<?php 
// The require statement is used to copy a required content from the usersfunc file to this one. 
require 'usersfunc.php';
//An include statement is used to add the header of the page in just one seperate file which is used in all other php file.
include 'hf/header.php';
// error handling if id doesn't exits in super global GET then the program will throw a Not found error by reading a message on a specificed file and exit the program.

session_start();    //session start
if(!isset($_SESSION['username']))     //if session not found redirect to login page
{
header('location:login.php');
} 


if (!isset($_GET['id'])){
    include "hf/error.php";
    exit;
} 
$employeeId = $_GET['id'];

//This will throw a Not found error by reading a message on a specificed file if the Employee ID is wrong and exit the program.
$employeedata = getEmployeeById ($employeeId);
if (!$employeedata){
    include "hf/error.php";
    exit; 
}


$pay = 0;

// Function that calculates tax based on the bands stated in the JSON
function calculateTax($employeedata){
    
    global $pay; 
// These global variables are now accessible outside of the funtion. This is needed when creating the new variables that calculate pre and post tax.
    global $salary;

    $jsontax = file_get_contents('json/tax-tables.json');

    $employeesjsontax = json_decode ($jsontax, true);
    
    foreach($employeesjsontax as $taxband){
        $min = $taxband['minsalary'];
        $salary = $employeedata['salary'];
        $max = $taxband['maxsalary'];
        $taxrate = $taxband['rate'];
        $txrate = $taxrate/100;
        
        //Finding the tax band
        if ($employeedata['currency'] == 'USD'){
            return $pay += 0; // if the currency is in USD there will be zero tax collaction as it will be assumed that they will pay tax in their country.
        }      
        
        elseif ($salary < $min){
            return $pay += 0;  
        }

        elseif ($salary > $min && $salary < $max){
            $pay += ($salary - $min) * $txrate;
        }
    }
    
    return $pay;
     
}
    
// New variables with calculations
$postTax = calculateTax($employeedata);
$monthlyTax = ($postTax / 12);
$finalCalc = ($salary - $postTax);
$monSal = ($finalCalc / 12);

?>

<div class="container">
<div class="card">
    <div class="card-header">
        <h3>View Employee: <b><?php echo $employeedata['firstname']. $employeedata['lastname'] ?></b> </h3>
    </div>   

    <div class="card-body">
            <a class="btn btn-success" href="update.php?id=<?php echo $employeedata['id'] ?>">Update</a>
            <a class="btn btn-danger" href="index.php">Back</a>
    </div> 
    <table border=1>
        <tbody>
            <tr>
                <th> Employees Id: </th>
                <td><?php echo $employeedata['id'] ?> </td>
            </tr>

            <tr>
                <th> First Name:  </th>
                <td><?php echo $employeedata['firstname'] ?> </td>
            </tr>

            <tr>
                <th> Last Name:  </th>
                <td><?php echo $employeedata['lastname'] ?> </td>
            </tr>

            <tr>
                <th> DOB: </th>
                <td><?php echo $employeedata['dob'] ?> </td>
            </tr>

            <tr>
                <th> Email:  </th>
                <td><?php echo $employeedata['email'] ?> </td>
            </tr>

            <tr>
                <th> Phone:   </th>
                <td><?php echo $employeedata['phone'] ?> </td>
            </tr>

            <tr>
                <th>  Job Title: </th>
                <td><?php echo $employeedata['jobtitle'] ?> </td>
            </tr>

            <tr>
                <th> NI Number:  </th>
                <td><?php echo $employeedata['nationalinsurance'] ?> </td>
            </tr>

            <tr>
                <th> Address: </th>
                <td><?php echo $employeedata['homeaddress'] ?> </td>
            </tr>

            <tr>
                <th> Currency: </th>
                <td><?php echo $employeedata['currency'] ?> </td>
            </tr>

            <tr>
                <th> Salary:  </th>
                <td> <?php echo '£'.number_format($employeedata['salary']) ?> </td>
            </tr>

            <tr>
                <th> Monthly Tax Paid: </th>
                <td> <?php echo '£'.number_format($monthlyTax, 2) ?> </td>
            </tr>

            <tr>
                <th> Yearly Tax Paid: </th>
                <td> <?php echo '£'.number_format($postTax, 2) ?> </td>
            </tr>

            <tr>
                <th> Final Calculation: </th>
                <td> <?php echo  '£'.number_format($finalCalc, 2) ?> </td>
            </tr>

            <tr>
                <th> Monthly Salary: </th>
                <td> <?php echo '£'.number_format($monSal, 2) ?> </td>
            </tr>
        </tbody>

    </table>

</div>
</div>


<?php include 'hf/footer.php'; ?>
