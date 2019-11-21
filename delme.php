<?php

echo '<pre>';

    print_r($_POST);
echo '</pre>';

echo $_POST['post_code'];
?>


<html>
<head></head>
<body>
    
    <form method="post">
    
    <input type="text" name="post code" value="12345">
     
    <input type="submit" name='submit me' value="submit">
    
    
    
    </form>
    
    
    
    </body>


</html>