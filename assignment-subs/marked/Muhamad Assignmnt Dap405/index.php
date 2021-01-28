<?php 
// The require statement is used to copy a required content from the usersfunc file to this one. 
require 'usersfunc.php';

 //An include statement is used to add the header of the page in just one seperate file which is used in all other php file.
 include 'hf/header.php';
 
session_start();    //session start
if(!isset($_SESSION['username']))     //if session not found redirect to homepage
{
header('location:login.php');
} 
?>

<?php 
$employeesjsondata = getEmployee(); // calling a function which get's employee from jason
echo "<table border=1>
    <tr>
        <th>Image: </th>
        <th>Employee Id: </th>
        <th>First Name: </th>
        <th>Last Name: </th> 
        <th>Email: </th>
        <th>Phone No: </th>
        <th>Actions</th>
    </tr>";   //table heading for to display the name of what is going to be in each column.


    foreach ($employeesjsondata as $employeedata){
        echo "<tr>";
        echo "<td>" .$employeedata['photo']. "</td>";
        echo "<td>" .$employeedata['id']. "</td>";
        echo "<td>" .$employeedata['firstname']. "</td>";
        echo "<td>" .$employeedata['lastname']. "</td>";  
        echo "<td>" .$employeedata['email']. "</td>";
        echo "<td>" .$employeedata['phone']. "</td>"; // table data which uses an assigned variable that reads and find employees data from json file. 
        echo '<td><a href="view.php?id='.$employeedata["id"].'" class="btn btn-outline-info">View</a>  
                  <a href="update.php?id='.$employeedata["id"].'" class="btn btn-outline-secondary">Update</a>
        </td>'; // linked pages with button to allow users to navigate to viw payslips and update employee data if there are latest changes to the employee records.

        echo "</tr>";
    }
        echo "</table>";

        //An include statement is used to add footer to the page from a  seperate file this is avoid a new html template in each file .
    include 'hf/footer.php' 
?>