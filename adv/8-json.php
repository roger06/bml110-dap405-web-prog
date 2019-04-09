<?php

 
// JSON
// generating - parsing



    
?>
<!DOCTYPE html>
<html lang="en">
<head>
     
    
    <title>JSON</title>

   
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <style type="text/css">
        body {
            padding-top: 5rem;
        }

        .starter-template {
            padding: 3rem 1.5rem;

        }
    </style>
</head>

    
<body>

    

    <main role="main" class="container">

        <div class="starter-template">
            <h1>PHP and JSON</h1>

            <p>JSON has been in core PHP since 5.2.0</p>


            <h2>Convert PHP array into JSON</h2>

            <?php

//            one 'record'
            $myarray = array (
            'name' => 'Hadley',
            'gender' => 'm',
            'sports'=>array('snooker','skiing','cricket'),
            'age'=>10


            );

//            multiple...

//             $myarray =array(
//                 array (
//            'name' => 'Hadley',
//            'gender' => 'm',
//            'sports'=>array('snooker','skiing','cricket'),
//            'age'=>10
//
//
//            ),
//                 array (
//            'name' => 'Bronwyn',
//            'gender' => 'f',
//            'sports'=>array('running','swimming','dance'),
//            'age'=>7
//
//
//            )
//             );
//





            echo '<pre>'; print_r($myarray); echo '</pre>';

        echo json_encode($myarray);



            ?>

        <h2>Decode JSON</h2>
        <?php

          $kids = '{"name":"Hadley","gender":"m","sports":["snooker","skiing","cricket"],"age":10} ' ;

          print_r(json_decode($kids, true)  );  // true gives us an array

            echo '<br>';
          print_r(json_decode($kids)  );  // object
           echo '<br><br>';

            if (is_object(json_decode($kids))) echo "object!!";
             echo '<br><br>';

//            echo get_object_vars(json_decode($kids));
            
            // TODO - put this into a variable
        ?>
        </div>

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
