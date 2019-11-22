<!DOCTYPE html>
<html>
<head>
          <!-- Bootstrap core CSS -->

      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
 <style>
     * {

      font-family: arial;

     }

     body {

        margin-left: 10%;
        margin-right: 10%;
         margin-top: 5%;

     }


</style>
    <title>DAP501 URLs</title>

    </head>


<body>

<?php

define("URL", 'http://bsch-dev.chi.ac.uk/~');


$users = array(
'Charlie'=>'cbailey6',
    'Lia'=>'lchavda1',
    'Samuel'=>'scorpez1',
    'Harry'=>'hfinnis1',
    'Luke F'=>'lforema1',
    'Jamie'=>'jgraham5',
    'Matthew K'=>'mkissel1',
    'Luke M'=>'lmengel1',
    'Dylan'=>'dmyers1',
    'Daniel'=>'draper1',
    'Matthew R'=>'mrobins5',
    'Andrew'=>'ashakes2',
    'Blake'=>'bsquire1',
    'Ryan'=>'rward6',
    'Liam'=>'lwingro1'
);?>


    <div class="container">

    <h1>DAP405 - Web Design and Programming</h1>
    <h2>Assignment URLs</h2>
    <table class="table table-striped">
    <thead>
      <tr>
        <th>Firstname</th>
        <th>URL</th>

      </tr>
    </thead>
    <tbody>
<?php


foreach ($users as $name=>$username) {

    $username = strtoupper($username);
    echo '<tr><td>';

    echo $name;

    echo '</td><td> <a href="';

    echo URL .  $username.'/dap405/assignment/';

    echo '" target="_blank">'.URL. $username.'/dap405/assignment</a>';
     echo '</td>';
     echo '</tr>'; // row

}



?> <tbody>
        </table>
    </div><!--    container-->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </body>

</html>

