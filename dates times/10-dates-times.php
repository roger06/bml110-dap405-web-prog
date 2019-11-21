<?php


// Date and times
//




?>
<!DOCTYPE html>
<html lang="en">
<head>


    <title>Date and times</title>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <style type="text/css">
        body {
            padding-top: 5rem;
        }

        .starter-template {
            padding: 3rem 1.5rem;
            text-align: center;
        }
    </style>
</head>


<body>



    <main role="main" class="container">

        <div class="starter-template">
            <h1>Date and times</h1>

        </div>
        <p>The date() function is our starting point but <b>echo date();</b> does nothing. See <a href="http://php.net/manual/en/function.date.php">http://php.net/manual/en/function.date.php</a></p>
        <hr>

        <p><b>echo date('y');</b> gives us the two digit current year.</p>
        <?php echo date('y');?>
         <hr>
        <p><b>echo date('Y');</b> gives us the four digit current year.</p>
        <?php echo date('Y');?>

         <hr>
        <p><b>echo date('Y');</b> gives us today's date.</p>
        <?php echo date("F j, Y, g:i a"); ?>

        <p>We can format a timestamp <b>echo date("F j, Y, g:i a", 1514826041);</b>- 1526917424 (epoch time).</p>
        <?php echo date("F j, Y, g:i a", 1514826041); ?>
        <hr>
           <p><b>echo time();</b> gives us an epoch timestamp - current time in seconds from  1 Jan 1970</p>
                <?php echo time(); ?>

        <p>But we still use date() to print out time e.g. <b>echo date('G i')</b> = </p>

                <?php  echo 'time = '.date('G:i'); ?>
    </main>
    <!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</body>
</html>
