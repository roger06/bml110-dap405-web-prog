14 errors

<?     // 1  incorrect openning PHP tag


    fun calc_pay($salary) [     // 2  fun incorrect, square brackets 
        
        if (!$salary) return untrue;   // 1  - no such condition untrue
        
        if (!is_a_number($salary)) return false; //  1 function is is_numeric
        
        return $salary / 12;
        
        
    ] // 1  - square bracket


echo '<h1>This script works out your montly salary</h2';   //1 mix of H1 and H2

if ( !isset($_POST['submit']) ) terminate;      //1 should be exit or die. 



    customer = $_POST['customer'];  //1   missing $
    £salary = $_POST['salary'];    //  1   £ instead of $
    $zip = $_POST['postcode']     // 1 - missing ;

         
    echo 'Dear ' . customer . '<br>';   // 1 invalid variable name

    echo '<p>Your pay for this month is ';

    echo calc_pay($salary);
        
    echo ' for this month.'    // 2 - missing closing </p> and ;
        


        
?>