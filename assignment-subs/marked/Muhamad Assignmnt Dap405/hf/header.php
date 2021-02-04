<!doctype html>
<head>
    <title> Payroll App </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>

<div class="nav-bar">
    <!--alt tags are used to ensure greater accessibility if the image is not displayed correctly-->
    <div id="logo">
      <a href="index.php"><img src= "./css/logo.jpg" alt="Payroll App" /></a>
    </div>

    <div class="menu-nav">
        <a href="create.php"><button class="btn btn-outline-success">Add Employee</button></a> <!-- button created using bootstrap classes for adding a new Employee on click taken to a new form page -->
        <a href="logout.php"><button class="btn btn-outline-danger">Logout</button></a> <!-- button created using bootstrap classes for logging out the logged client -->
    </div>
</div>

