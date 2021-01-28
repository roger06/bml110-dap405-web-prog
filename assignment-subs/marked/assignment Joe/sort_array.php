<?php
    
    function sortArray($employee_json, $sort_filter, $AorD){
        $firstname  = array_column($employee_json, 'firstname');
        $secondname = array_column($employee_json, 'lastname');
        $salary = array_column($employee_json, 'salary');
        switch ($AorD){
            case "Ascending":
                $AorD = SORT_ASC;
                break;
            case "Descending":
                $AorD = SORT_DESC;
                break;
        }
        #https://www.w3schools.com/php/php_switch.asp
        switch ($sort_filter){
            case "First name":
                #https://www.php.net/manual/en/function.array-multisort.php
                array_multisort($firstname, $AorD, $secondname, $salary, $employee_json);
                break;
            case "Last name":
                array_multisort($secondname, $AorD, $firstname, $salary, $employee_json);
                break;
            case "Salary":
                array_multisort($salary, SORT_ASC, $firstname, $secondname, $employee_json);
                break;


        }
        
        
        return $employee_json;
    }

?>