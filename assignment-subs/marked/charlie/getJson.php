<?php
#####################################################################
#This file executes on all pages, although more resource hungry, it #
#ensures that any changes that are made to the json are immeadiately#
#reflected to the user. mitigating their chances of looking at      #
#things that no longer exist and getting themselves into trouble    #
#####################################################################

ini_set('display_errors', '0');


//Get employee Data
$employee_file = "json_files/employees-final.json";
$employee_data_json = file_get_contents($employee_file);
$employee_data_array = json_decode($employee_data_json, true);

//Get clearance levels for users.
$clearance_file = "json_files/role-clearance-level.json";
$clearance_json = file_get_contents($clearance_file);
$clearance_array = json_decode($clearance_json, true);

//Get the tax files
$tax_file = "json_files/tax-tables.json";
$tax_json = file_get_contents($tax_file);
$_SESSION["tax_array"] = json_decode($tax_json, true);

//get Font awesome icon relationships (for eployee 'otherroles')
$icon_file = "json_files/other-role-icons.json";
$icon_json = file_get_contents($icon_file);
$_SESSION["icons"] = json_decode($icon_json, true);

//Calculate the highest salary of an employee (used by the filter aside to set maximum values on the sliders).
function GetMaxSalary($employee_data_array){
    $maximumSalary = 0;
    foreach($employee_data_array as $employee){
        if($employee["salary"] > $maximumSalary){$maximumSalary=$employee["salary"];}
    }
    return $maximumSalary;
}
?>