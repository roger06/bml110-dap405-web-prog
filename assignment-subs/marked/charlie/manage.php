<?php
######################################################
#A page for adding or removing users from the system.#
######################################################

ini_set('display_errors', '0');
session_start();
require "getJson.php";
require "auth.php";
require "layout.php";

//Only people with the highest clearanc can add/remove users. redirect if not allowed.
if ($currentClearance < 2){
    header("location: process.php");
}
?>
<link rel="stylesheet" href="css/manage_style.css">

<main>
    <div id="adddiv">
        <h2> Add Employee </h2>
        <p> WARNING! Some fields are required but NO validation is carried out on these entries, please ensure data is entered correctly!</p>
        <form action="add_employee.php" method="POST" name="addemployee"enctype="multipart/form-data">
        <?php
            //Array that defines the html input types of each employee property
            $properties = [
            "firstname"=>"text",
            "lastname"=>"text",
            "grade"=>"number",
            "jobtitle"=>"text",
            "nationalinsurance"=>"text",
            "photo"=>"file",
            "department"=>"text",
            "reports"=>"text",
            "linemanager"=>"text",
            "linemanagerid"=>"number",
            "salary"=>"number",
            "currency"=>"text",
            "phone"=>"tel",
            "email"=>"email",
            "homeemail"=>"email",
            "homeaddress"=>"text",
            "nextofkin"=>"text",
            "employmentstart"=>"date",
            "employmentend"=>"date",
            "dob"=>"date",
            "previousroles"=>"text",
            "otherroles"=>"text",
            "pension"=>"checkbox",
            "pensiontype"=>"checkbox",
            "companycar"=>"checkbox"];

            //Create input fields.
            foreach($properties as $key=>$type){
                $additionalMessage = "";
                //If the json stores the users data as an array then user must enter the data as comma seperated values, this provides a not for the user.
                if (in_array($key, ["reports", "previousroles", "otherroles"])) { 
                    $additionalMessage = "<br>(comma seperated values)";
                }

                //Clarifies what the user is checking the pension box for.
                if ($key == "pensiontype"){ $additionalMessage = " (check for final)"; }

                //Echo labels and inputs.
                echo("<div><label for='".$key."'>".$key.$additionalMessage.":</label>");
                echo("<br>");
                echo("<input type='".$type."' name='".$key."' id='".$key."' onClick='this.select();'");
                
                //Define required input fields on the page
                if (in_array($key, ["firstname", "lastname", "grade", "jobtitle", "nationalinsurance", "photo", "salary", "currency", "phone", "email"])){ echo " required "; }
                echo("></div>");
            } ?>
            <input type="submit" value="Add" id="submit">
        </form>
    </div>
        <div id="deletediv">
            <h2>Delete Employee</h2>
            <form action="delete.php" method="POST" name="deleteemployee">
                <label for="idsearch">ID To Delete:</label>
                <input type="number" name="id"><br>
                <input type="submit" value="Find Employee">
            </form>
        </div>
</main>
</body>
</html>