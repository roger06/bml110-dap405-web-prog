<!DOCTYPE html>
<html>

    <head>
        <title>CHANGE-ME</title>
    </head>

    <body>

        <h1>PHP can be embedded in HTML!!!!!</h1>
        <p>Hi, I am 
        <?php echo 'a line of PHP';?> 
        
        
        a line of HTML</p>

        <hr>
        <hr>

        <?php echo "<h3>And this is a line of HTML generated by PHP</h3>";?>
        
        <hr>
        <p>Both the above are totally pointless as can be done in HTML, so what's the point? </p> 
        <p>Well, it's when we want to print out a variable</p>
    
        <?php $name = 'Adam'; ?>
        
        <p>Such as, it's when we want to print out a variable</p>
        <p>Hi, this is <?php echo $name;?> and I'm a variable</p>
        
<hr>
        
        <p>Or echo out multiple values, without having to generate the HTML for each.</p>
        
        <?php $name = array('Roger', 'Dave', 'Susan', 'Mia', 'Hollie', 'Ricky'); 
        
        
            foreach ($name as $thename) {
                
                echo "<h4>My name is ".$thename."</h4>";
            }
        
        ?>
        
        
        
        
        
        
    </body>

</html>
