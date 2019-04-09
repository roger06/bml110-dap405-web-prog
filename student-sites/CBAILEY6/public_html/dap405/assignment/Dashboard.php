<!--1707071-->
<?php include "header.php"; //This includes the header file, The header hile contains
//everything that will be included at the top of each page.
 ?>
<!DOCTYPE html>

<html> <!-- Opening HTML Tag-->
<head> <!-- Opening Head Tag-->
	<style> /* In-page styling to center the column */
	.col-centred {       /* In-page styling to center the column */
	 float: none;
	 margin: 0 auto;
	 }
	 body {
	 overflow-y: scroll;
	 overflow-x: hidden; /* Stops Scrolling of the page. */
	 }

	 td { /* Aligning the table data to be centered */
	 	text-align: center;
	 }
	</style> <!-- End of CSS Style Tag-->
	<title>Dashboard of Employees</title> <!-- Title tag, Displays the page title in the chrome tag.-->
</head>

<body> <!-- Opening Body Tag.-->
	<h1 style="text-align: center;">E-Pay</h1>
	<!-- Define H1 Tax to give the Employee heading.-->
	<div class="row">
		<!--Start of the div class Riw  -->
		<div id="table" class="col-md-6 col-centred">
			<!--Center the class using bootstrap columns md-6.-->
<!-- Search form -->
<input class="form-control" id="search" onkeyup="SearchTable()" type="text" placeholder="Search by Employee" style="text-align: center";> <!--Input Search Bar, Uses ID of Search and OnKeyUp Function-->

			<table class="table"> <!-- Table tag-->

				<tr> <!-- Opening Table Row-->
					<td><b>ID</b></td>   <!-- Table tag.-->

					<td><b>Firstname</b></td><!--Table Data Firstname-->
					<td><b>Surname</b></td><!--Table Data Surname-->
					<td><b>Line Manager</b></td><!--Table Data Line Manager-->
					<td><b>Payslip</b></td><!--Table Data Payslips-->
				</tr>
				<?php // Opening PHP Tag
include "functions-include.php"; //Including the functions file, The function file handles the JSON. All comments in relation to this
// are in the functions-include file.
$employees = JSON(); //Set the variable of employees to = JSON.
foreach ($employees as $emp) { //Foreach loop to go through my decoded JSON(php array) and search for each employees and present Firstname, Suranem, Line manager & ID.
    echo "<tr>";//Echo the table row
    echo "<td>" . $emp["id"] . "</td>";//Echo the table table data with a column full of ID's from the JSON.
    echo "<td>" . $emp["firstname"] . "</td>";//Echo the table table data with a column full of Firstname's from the JSON.
    echo "<td>" . $emp["lastname"] . "</td>";//Echo the table table data with a column full of Lastnames's from the JSON.
    echo "<td>" . $emp["linemanager"] . "</td>";//Echo the table table data with a column full of Line managers's from the JSON.
    echo "<td><a href='slip.php?id=" . $emp['id'] . "'>View Payslip</a></td>"; //Echo the table table data with a column full of links to the employee payslips.
    echo "</tr>";//Echo the closing of the Table Row.

}
?> <!--Close php-->
			</table> <!-- End of Table -->
		</div><!-- End of child DIV. -->
	</div>  <!-- End of Parent DIV. -->
	<?php
include "footer.php"; // Including the footer.php, This contains all the code for the bottom of each webpage.

?>

				<!-- THE BELOW SCRIPT IS 100 % MY ORIGINAL WORK, I have edited a few of the examples and variables that W3 SCHOOLS SHOWS. -->

<script> //Open the scripting tags, Allows JAVA to read. Javascript placed at bottom of the document, I would have to use DOC READY if placed at the top.
		//Reads top down, Therefore would ignore the code due to element calling the scrip is place above.
function SearchTable() { //Define a function called SearchTable
    var keys, filter, classify, tr, td, i; //Define all of the variables
  keys = document.getElementById("search"); //This allows the users keypresses to select elements within the page.
  filter = keys.value.toUpperCase();//This takes the value of the keypress and formats to Upper case.
  classify = document.getElementById("table");//Selecting the Table element in which the data we want to call sits within.
  tr = classify.getElementsByTagName("tr");//Classify meaning filter, Filter the Table Row Element.

  for (i = 0; i < tr.length; i++) { //For loop to query the rows of data.
    //td = tr[i].getElementsByTagName("td")[0]; //If the search matches anything in the table rows, Hide others.
    td = tr[i];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) { //If the search doesn't match anything in the Table Rows, -1 = take away the rows.
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script> <!-- END OF SCRIPT-->
</body><!-- End of Body-->
</html><!-- End of HTML-->
