<?php
#########################
//Table Filter by Name
#########################
if(isset($_GET["namesearch"]) && $_GET["namesearch"]!=""){
    $filtered_array = array();
    $nameSearch = $_GET["namesearch"];

    foreach($employee_data_array as $employee){
        $name = $employee["firstname"]." ".$employee["lastname"];
        if(stripos($name, $_GET["namesearch"]) !== false){
            $filtered_array[] = $employee;
        }
    }    
    $employee_data_array = $filtered_array;
}
#########################
//Table Filter Minimum Salary
#########################
if(isset($_GET["minimumsalary"]) && intval($_GET["minimumsalary"])!=0 && $currentClearance>=1){
    $filtered_array = array();
    $minimumSalary = intval($_GET["minimumsalary"]);

    foreach($employee_data_array as $employee){
        $salary = intval($employee["salary"]);
        if($salary >= intval($_GET["minimumsalary"])){
            $filtered_array[] = $employee;
        }
    }
    $employee_data_array = $filtered_array;
}
#########################
//Table Filter Maximum Salary
#########################
if(isset($_GET["maximumsalary"]) && intval($_GET["maximumsalary"])!=0 && $currentClearance>=1){
    $filtered_array = array();
    $maximumSalary = intval($_GET["maximumsalary"]);

    foreach($employee_data_array as $employee){
        $salary = intval($employee["salary"]);
        if($salary <= intval($_GET["maximumsalary"])){
            $filtered_array[] = $employee;
        }
    }
    $employee_data_array = $filtered_array;
}
#########################
//Table Sorting algorithm
#########################
if(isset($_GET["sortby"]) && in_array($_GET["sortby"], ["id", "lastname", "salary"])){

    function ArraySortByColumn(&$arr, $col, $dir = SORT_ASC) {
        $sort_col = array();
        foreach ($arr as $key=> $row) {
            $sort_col[$key] = $row[$col];
        }
    
        array_multisort($sort_col, $dir, $arr);
    }
    
    if(isset($_GET["order"]) && $_GET["order"]=="descending"){ $order = SORT_DESC; }
    else{ $order= SORT_ASC; }
    ArraySortByColumn($employee_data_array, $_GET["sortby"], $order);
    }

?>