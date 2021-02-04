<?php

// This function is to get employee record and display and return employee array.
function getEmployee ()
{
    //$json  variable is given to get the content of the json file from the given path of the file.
    return json_decode (file_get_contents('json/employees-final.json'), true); 
}

function getEmployeeById ($id) 
{
    $employeesjsondata = getemployee(); // tthis variable will give all the employee records.
    
    foreach ($employeesjsondata as $employeedata){
        if ($employeedata['id'] == $id) {
            return $employeedata;  //this checks to if the employee id is same as the arguement id display the employee record.
        }   
    }
        return null; //Nothing will be return if the employee id doesn't match the arguemnt id.  
}

function createEmployee($data)
{
    $employeesjsondata = getEmployee();

    $data['id'] = [];

    $employeesjsondata[] = $data;

    putJson($employeesjsondata);

    return $data;   
}

function updateEmployee ($data, $id) 
{   
    $updateEmployee = [];
    $employeesjsondata = getEmployee();  // This varaiable will call employees function that was created earlier to get json records.
    //this loop will loop through each employee record and $i is included for iterating record. 
    foreach ($employeesjsondata as $i => $employeedata) {
        if ($employeedata['id'] == $id) {
            $employeesjsondata[$i] = $updateEmployee = array_merge($employeedata, $data); //this will reassign the new data to the employeejsondata. and by using array_merge function one or more arrays can be merged into one. to keep the existing and new data.
        }   
    }

    putJson($employeesjsondata);

    file_put_contents('json/employees-final.json', json_encode($employeesjsondata)); //this will pull the updated information  into the employee json file.
    return $updateEmployee;
}

function putJson($employeesjsondata)
{
    file_put_contents(__DIR__ . 'json/employees-final.json', json_encode($employeesjsondata, JSON_PRETTY_PRINT));
} // function that will add the new data to the json file by writing new employees record and encoding it. 

function validateEmployee($employeedata, &$errors)
{
    $isValid = true;
    // Start of validation

    if (!$employeedata['id']) {
        $isValid = false;
        $errors['id'] = 'Employee id is mandatory'; // this is to validate whether the user details have been correctly entered if not the error message will ask the user to add a right text.
    }
    if (!$employeedata['firstname']) {
        $isValid = false;
        $errors['firstname'] = 'first Name is mandatory'; // this is to validate whether the user details have been correctly entered if not the error message will ask the user to add a right text.
    }

    if (!$employeedata['lastname']) {
        $isValid = false;
        $errors['lastname'] = 'last Name is mandatory'; //  Again this is to validate whether the user details have been correctly entered if not the error message will ask the user to add a right text.
    }
    if ($employeedata['email'] && !filter_var($employeedata['email'], FILTER_VALIDATE_EMAIL)) {
        $isValid = false;
        $errors['email'] = 'This must be a valid email address'; // this error message is especially for the email. that validate the text in an email format if the text is not written in an email format it will display an error to the user and ask for a valid email.
    }

    if (!$employeedata['phone']) {
        $isValid = false;
        $errors['phone'] = 'Phone number is mandatory';
    }


    if (!$employeedata['homeaddress']) {
        $isValid = false;
        $errors['homeaddress'] = 'HomeAddress is mandatory';
    }

    if (!$employeedata['jobtitle']) {
        $isValid = false;
        $errors['jobtitle'] = 'Job Title is mandatory'; // this is to validate whether the user details have been correctly entered if not the error message will ask the user to add a right text.
    }

    if (!$employeedata['department']) {
        $isValid = false;
        $errors['department'] = 'Department is mandatory'; // this is to validate whether the user details have been correctly entered if not the error message will ask the user to add a right text.
    }

    if (!$employeedata['linemanager']) {
        $isValid = false;
        $errors['linemanager'] = 'Line Manager is mandatory'; // this is to validate whether the user details have been correctly entered if not the error message will ask the user to add a right text.
    }

    if (!$employeedata['salary']) {
        $isValid = false;
        $errors['salary'] = 'Salary is mandatory'; // this is to validate whether the user details have been correctly entered if not the error message will ask the user to add a right text.
    }

    if (!$employeedata['dob']) {
        $isValid = false;
        $errors['dob'] = 'Date of Birth is mandatory'; // this is to validate whether the user details have been correctly entered if not the error message will ask the user to add a right text.
    }

    if (!$employeedata['pension']) {
        $isValid = false;
        $errors['pension'] = 'Pension is mandatory'; // this is to validate whether the user details have been correctly entered if not the error message will ask the user to add a right text.
    }

    if (!$employeedata['companycar']) {
        $isValid = false;
        $errors['companycar'] = 'company car detail is mandatory'; // this is to validate whether the user details have been correctly entered if not the error message will ask the user to add a right text.
    }

    // End Of validation

    return $isValid;
}

?>