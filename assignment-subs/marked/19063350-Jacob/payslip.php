<html>
  <head>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js">
    </script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js">
    </script>
    <?php
include ('tax-band-functions.php'); //
function getemp() //function made to return the employee data by also gets the individual employee ID after they click through from the table
{
    $json_file = "data/employees-final.json";
    $emp_json_data = file_get_contents($json_file);
    $emp_array = json_decode($emp_json_data, true);
    $empid = $_GET['id'];
    foreach ($emp_array as $data)
    {
        if ($data['id'] == $empid)
        {
            $emp = $data;
        }
    }
    
    return $emp;
}
?>
  </head>
  <div class="container">
    <div class="row">
      <div class="well col-xs-10 col-sm-10 col-md-8 col-xs-offset-1 col-sm-offset-1 col-md-offset-2">
        <div class="row">
          <div class="col-xs-8 col-sm-8 col-md-8">
            <p>
              <strong>Name:
              </strong> 
              <?php echo getemp() ['firstname'] . " ";
echo getemp() ['lastname']; ?>
            </strong>
          <br>
          <strong>Job Role:
          </strong> 
          <?php echo getemp() ['jobtitle']; ?>
          <br>
          <strong>Email:
          </strong> 
          <?php echo getemp() ['email']; ?>
          <br>
          <strong>Tel No:
          </strong> 
          <?php echo getemp() ['phone']; ?>
          </abbr>
        </p>
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 text-right">
      <p>
        <em>
          <strong>Employee ID:
          </strong> 
          <?php echo getemp() ['id']; ?>
        </em>
        <br>
        <br>
        </p>
    </div>
  </div>
  <div class="row">
    <div class="text-center">
      <h2>
        <?php echo getemp() ['firstname']; ?>'s <?php $month = date('m'); //this displays the current month
if ($month == "12") {
  echo "December"; //this specifies that if the month is the 12th of the year, it will read December
} 
?> Payslip
      </h2>
      <br>
    </div>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Company Car?
          </th>
          <th class="text-center">Annual Gross Salary
          </th>
          <th class="text-center">Annual Tax
          </th>
          <th class="text-center">Annual Net Salary
          </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="col-md-1">
            <em>
            <?php echo strtoupper(getemp() ['companycar']) ?>
            </em>
          </td>
          <td class="col-md-1 text-center">
          <?php echo '£' . number_format(getemp() ['salary'], 2); ?>
          </td>
          <td class="col-md-1 text-center">
          <?php $totaltax = getemp();
            echo '£' . number_format(totalTax($totaltax), 2);?>
          </td>
          <!--get emp returns the current emp (clicked on) that then gets called by monthly tax -->
          <td class="col-md-1 text-center">
            <?php echo '£' . number_format(finalaftertax(getemp() ['salary'], getemp() ['companycar']), 2);?>
          </td> 
        </tr>
        <tr>
      </td>
      </tr>
    <tr>
      <td>   
      </td>
      <td>   
      </td>
      <td class="text-center">
      <br>
        <p class="text-left">
          <strong>Monthly Gross Salary:
          </strong>
          <p class="text-left text-danger">
          <strong>Deductions
          </strong>
        </p>
        <p class="text-left">
          <strong>Monthly Tax: 
           </strong>
           </p>
        
      </td>
      <td class="text-center">
      <br>
      <p>
          <strong><?php $grossmonthlywage = getemp();
            echo '£' . number_format(monthlygross($grossmonthlywage), 2);?>
          </strong>
        </p>
        <p>
        <br>
        </p>
        <p>
          <strong>- 
          <?php $monthly = getemp();
            echo '£' . number_format(monthlyTax($monthly), 2); ?>
          </strong>
        </p>
      </td>
    </tr>
    <tr>
      <td>   
      </td>
      <td>   
      </td>
      <td class="text-center">
        <h4>
          <strong>Net Pay: 
          </strong>
        </h4>
      </td>
      <td class="text-center text-primary">
        <h4>
          <strong><?php echo '£' . number_format(finalnetmonthly(getemp()['salary'], getemp()['companycar']), 2); ?>
          </strong>
        </h4>
      </td>
    </tr>
    </table>
  </td>
</div>
</div>
</div>
</html>