<!-- Link header file -->
<?php
require('header.php');
?>

<!-- Start of page welcome -->
<main>
  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Welcome</h1>
        <br>
        <p class="text-muted">
          <?php
          date_default_timezone_set('Europe/London');
          echo "Today is " . date(" jS \of F h:i A");
          ?>
        </p>
        <br>
        <p class="lead text-muted">You can view employee data and generate payslips below. To quickly find out the tax on a new salary use this button.</p>
        <!-- Include button for quick use of tax calculation form -->
        <p>
          <a href="calculatetaxpage.php" class="btn btn-primary my-2">Calculate Tax</a>
        </p>
      </div>
    </div>
  </section>
  <!-- End of page welcome -->

  <!-- Start of page redirect options -->
  <div class="album py-5 bg-light">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <div class="col">
          <div class="card shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Employee Data" preserveAspectRatio="xMidYMid slice" focusable="false">
              <title>Employee Data</title>
              <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Employee Data</text>
            </svg>
            <div class="card-body">
              <p class="card-text">Here you will find a full list of employees and their data.</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="table.php" class="btn btn-sm btn-outline-secondary">View</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Upload Employee Data" preserveAspectRatio="xMidYMid slice" focusable="false">
              <title>Upload Employee Data</title>
              <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Upload Employee Data</text>
            </svg>
            <div class="card-body">
              <p class="card-text">Upload a new JSON file to update the list of employees.</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="uploadform.php" class="btn btn-sm btn-outline-secondary">Upload</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Generate Payslips" preserveAspectRatio="xMidYMid slice" focusable="false">
              <title>Generate Payslips</title>
              <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Generate Payslips</text>
            </svg>
            <div class="card-body">
              <p class="card-text">Use this to generate payslips for all employees.</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="generate_pdf.php" class="btn btn-sm btn-outline-secondary">Generate</a>
                </div>
              </div>
            </div>
          </div>
        </div>
</main>
<!-- End of page redirect options -->

<!-- footer for homepage to go back to top for the navbar -->
<div class="p-4 p-md-5 mb-4 text-white rounded bg-light">
  <div class="btn-group">
    <a href="homepage.php" class="btn btn-sm btn-outline-secondary">Back to top</a>
  </div>
</div>
<br>

<!-- Link footer file -->
<?php
require('footer.php');
?>