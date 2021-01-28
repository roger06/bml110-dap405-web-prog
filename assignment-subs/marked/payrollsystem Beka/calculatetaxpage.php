<!-- Link header file -->
<?php
require('header.php');
?>

<!-- Page intro text -->

<br>
<main class="container">
  <h3 class="pb-4 mb-4 border-bottom">
    Tax Calculation
  </h3>
  <p>
    You can use the form below to work out a new take home pay after tax. This may help when looking at year new salary after a promotion or if you're looking to apply for a new role.
  </p>
  <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
    <div class="col-md-6 px-0">
      <!-- Start of tax calculation form -->
      <form action="calculatetax.php" method="post">
        Is your salary in GBP?: <input type="checkbox" name="GBP" value="y"><br><br>
        Do you have a company Car?: <input type="checkbox" name="compCar" value="y"><br><br>
        Salary: <input type="number" name="salary"><br><br>
        <input type="submit">
    </div>
  </div>
  </form>
  <!-- End of form -->

  <!-- Link footer file -->
  <?php
  require('footer.php');
  ?>