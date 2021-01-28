<?php
#################################################
#The main page with filters and employee table. #
#################################################

session_start();
//NOTE: The order of these "require" is important since some actions must be done before the array is filtered.
require "getJson.php";
$maximumPossibleSalary = (50000*ceil(GetMaxSalary($employee_data_array) / 50000)); //This rounds the maximum possible salary up to the nearest 50,000.
require "auth.php";
require "layout.php";
require "table_designer.php";
require "validate_filter.php";?>

<link rel="stylesheet" href="css/process_style.css"/>

    <main>
        <aside <?php if($currentClearance <1){echo("id='lowclearance'");}?>>
            <form action="process.php" method="GET" name="filter" id="filterform">
                <!-- Name Search field-->
                <label for="namesearch">Names Containing:</label>
                <input type="text" name="namesearch" id="namesearch" onClick="this.select();" <?php if(isset($nameSearch)){ echo 'value="'.$nameSearch.'"'; }?>>
                <?php
                //Only let the user filter by salary values if they have clearance (cannot maually edit url to filter values if not permitted either).                
                if ($currentClearance >= 1){
                    //minimum salary filter slider
                    echo("<label for='minimumsalary'>Min Salary:</label>");
                    echo("<div><input type='range' id='minimumsalary' step=1000 value='");
                    if(isset($minimumSalary)){ echo $minimumSalary; }                       //If the user has just filtered these values are persisted to the slider when the page updates.
                    else{echo "0";}                                                         //Else the slider defaults to Zero
                    echo("' min='1' max='".$maximumPossibleSalary."' name='minimumsalary' oninput='this.nextElementSibling.value = this.value' class='slider'> £<output>");
                    if(isset($minimumSalary)){ echo $minimumSalary; }                       //Also Persists default values to the output if previously filtered
                    else{echo "0";}

                    //Maximum salary filter slider
                    echo("</output></div><label for='maximumsalary'>Max Salary:</label><div><input type='range' id='maximumsalary' step=1000 value='");
                    if(isset($maximumSalary)){ echo $maximumSalary; }
                    else{echo $maximumPossibleSalary;}
                    echo("' min='0' max='".$maximumPossibleSalary."' name='maximumsalary' oninput='this.nextElementSibling.value = this.value' class='slider'> £<output>");
                    if(isset($maximumSalary)){ echo $maximumSalary; }
                    else{echo $maximumPossibleSalary;}
                    echo("</output></div>");
                }?>

                <div>
                    <label for="sortby">Sort by:</label>
                    <select id="sortby" name="sortby">
                        <option <?php if(isset($_GET["sortby"]) && $_GET["sortby"]=="id"){echo 'selected="selected"';}?>>id</option>
                        <option <?php if(isset($_GET["sortby"]) && $_GET["sortby"]=="lastname"){echo 'selected="selected"';}?>>lastname</option>
                        <?php 
                        //Only people with clearance can sort by salary (url is protected against manual sorting too).
                        if($currentClearance>=1){
                            echo("<option");
                            if(isset($_GET["sortby"]) && $_GET["sortby"]=="salary"){echo 'selected="selected"';}
                            echo(">salary</option>");}
                        ?>
                    </select>

                    <label for="ascending">Asc:</label>
                    <input type="radio" name="order" id="ascending" value="ascending" <?php if((isset($_GET["order"]) && $_GET["order"]=="ascending") || !isset($_GET["order"])){ echo"checked"; }?>>
                    <label for="descending"> Dsc:</label>
                    <input type="radio" name="order" id="descending" value="descending" <?php if((isset($_GET["order"]) && $_GET["order"]=="descending")){ echo"checked"; }?>>
                </div>
                <div id="formbutts">
                    <button onclick="location.href='process.php'" type="button">Reset</button> <!-- this is a jank way of resetting the form details because it's using php-->
                    <input type="submit" value="Filter">
                </div>
            </form>
        </aside>

<?php

$stylings = array("name" => 0, "includecurrency" => true, "alternate" => true );

//This generates the table of employee data.
echo(DesignTable($employee_data_array, $stylings, $currentClearance));
?>
    </main>
</body>
</html>
