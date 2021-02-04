<?php

  function handle_login($username, $password) {
    $valid_logins = array( // array containing valid logins
      array('username'=>'Admin', 'password'=>'password', 'type'=>'admin'),
      array('username'=>'User', 'password'=>'password', 'type'=>'standard')
    );
    $user_type = 'invalid'; // default user type is invalid

    $username == trim($username); // remove whitespace from beginning and end of username
    $password == trim($password); // remove whitespace from beginning and end of password

    foreach($valid_logins as $login) { // iterate through valid logins
      if ($username==$login['username'] && $password==$login['password']) { // check if login is valid
        $user_type = $login['type'];                                        // if true, set type
      }
    }

    return $user_type; // return user type
  }

  function check_user_type() {
    $user_type = null;

    if (isset($_SESSION['user_type'])) {  
      $user_type = $_SESSION['user_type']; // set user type to value in SESSION variable
      if ($user_type == 'invalid') {       // check if user type is invalid
        header('Location: index.php');     // if true return to login page
      }
    } else {                               // user type not set
      header('Location: index.php');       // return to login page
    }

    return $user_type; // return user type
  }

  function logout() {
    // html for logout button
    echo '<div class="col text-right">';
    echo '<form method="post" action="logout.php">';
    echo '<button type="submit" class="btn btn-primary">Logout</button>';
    echo '</form>';
    echo '</div>';
  }

  function top_bar($file) {
    // html for top bar
    echo '<div class="row top-bar">';
    echo '<div class="col-auto text-left">';
    echo '<a href="'.$file.'" aria-label="Back" data-toggle="tooltip" title="Back">';
    echo '<i class="fas fa-long-arrow-alt-left fa-2x"></i>';
    echo '</a>';
    echo '</div>';
    echo '<div class="col text-left">';
    echo '<form method="post" action="home.php">';
    echo '<button type="submit" class="btn btn-primary">Home</button>';
    echo '</form>';
    echo '</div>';
    logout();
    echo '</div>';
  }

  function check_tax_json($file) {
    $json_file = $file;
    $json = load_file($json_file);
    $tax_data = decode_json($json);
    $errors = array();

    $bracket_num = 1;
    foreach($tax_data as $bracket) {
      // check bracket has min salary
      if (!array_key_exists('minsalary', $bracket)) {
        array_push($errors, 'Bracket '.$bracket_num.' does not have min salary');
      } elseif (!is_numeric($bracket['minsalary'])) {
        array_push($errors, 'Min salary is not a number in bracket '.$bracket_num);
      }

      // check bracket has max salary
      if (!array_key_exists('maxsalary', $bracket)) {
        array_push($errors, 'Bracket '.$bracket_num.' does not have max salary');
      } elseif (!is_numeric($bracket['maxsalary'])) {
        array_push($errors, 'Max salary is not a number in bracket '.$bracket_num);
      }

      // check bracket has rate
      if (!array_key_exists('rate', $bracket)) {
        array_push($errors, 'Bracket '.$bracket_num.' does not have rate');
      }elseif (!is_numeric($bracket['rate'])) {
        array_push($errors, 'Rate is not a number in bracket '.$bracket_num);
      }

      $bracket_num++;
    }

    return $errors;

  }

  function edit_employee($employee, $invalid_fields) {

    $arrays = ['reports', 'previousroles', 'otherroles']; // employee fields which are arrays
    $checkboxes = ['pension', 'companycar'];              // employee fields which are boolean
    $numbers = ['linemanagerid', 'salary'];               // employee fields which are numbers
    $dates = ['employmentstart', 'employmentend', 'dob']; // employee fields which are dates

    foreach(array_keys($employee) as $key) { // iterate through keys of employee

      $label = '<label for="'.$key.'">'.$key.'</label>'; // generate label for field
      $checkbox = false;
      $id = false;
      $invalid = '';
      if (in_array($key, $invalid_fields)) { 
        $invalid = 'is-invalid'; // make input show as invalid if user input was invalid
      }

      // generate input fields
      switch ($key) {
        case $key == 'id': // case key is id
          $id = true;      // set if to true
        break;
        case in_array($key, $arrays): // case key is in array arrays - meaning date type is an array
          $value = implode(', ', $employee[$key]);
          $input = '<input type="text" class="form-control '.$invalid.'" name="employee['.$key.']" id="'.$key.'" value="'.$value.'">';
        break;
        case in_array($key, $numbers): // case key is in array numbers - meaning data type is numeric
          $input = '<input type="number" class="form-control '.$invalid.'" name="employee['.$key.']" id="'.$key.'" value="'.$employee[$key].'">';
        break;
        case in_array($key, $checkboxes): // case key is in array checkboxes - meaning data type is boolean
          if ($employee[$key] == 'y') {
            $value = 'checked';
          } else {
            $value = '';
          }
          $checkbox = true;
          $input = '<input type="checkbox" class="form-check-input '.$invalid.'" name="employee['.$key.']" id="'.$key.'"'.$value.'>';
        break;
        default: // else data type is string
          $input = '<input type="text" class="form-control '.$invalid.'" name="employee['.$key.']" id="'.$key.'" value="'.$employee[$key].'">';
        break;
      }

      if (!$id) {
        if ($checkbox) {
          echo '<div class="form-group form-check">';
          echo $input;
          echo $label;
        } else {
          echo '<div class="form-group">';
          echo $label;
          echo $input;
        }
        if (!empty($invalid)) {
          echo '<div class="invalid-feedback">Invalid field</div>';
        }
        echo '</div>';
      }
    }
  } 

  function validate_form($employee) {
    $invalid_fields = array();
    $employee['reports'] = explode(', ', $employee['reports']);             // create array from employee's reports
    $employee['previousroles'] = explode(', ', $employee['previousroles']); // create array from employee's previous roles
    $employee['otherroles'] = explode(', ', $employee['otherroles']);       // create array from employee's other roles
    if (isset($employee['pension'])) { // check if employee's pension is set
      $employee['pension'] = 'y';      // if true, employee has pension
    } else {
      $employee['pension'] = 'n';      // if false, employee does not have pension
    }
    if (isset($employee['companycar'])) { // check if employee's companycar is set
      $employee['companycar'] = 'y';      // if true, employee has company car
    } else {
      $employee['companycar'] = 'n';      // if false, employee does not have company car
    }

    if (empty($employee['firstname'])) {        // if first name is empty in employee array
      array_push($invalid_fields, 'firstname'); // first name is invalid
    }
    if (empty($employee['lastname'])) {         // if last name is empty in employee array
      array_push($invalid_fields, 'lastname');  // last name is invalid
    }
    if (!is_numeric($employee['linemanagerid'])) {  // if line manager id is not numeric
      array_push($invalid_fields, 'linemanagerid'); // line manger id is invalid
    }
    if (!is_numeric($employee['salary'])) {  // if salary is not numeric
      array_push($invalid_fields, 'salary'); // salary is invalid
    }

    return array($employee, $invalid_fields); // return employee and invalid fields as array

  }

  function load_file($filename) {

    if (file_exists($filename)) { // if file exists
      $file = file_get_contents($filename); // get contents

      if ($file) {    // if getting contents was successful
        return $file; // return file
      } else {
        $error = 'Failed to load file'; // set error 
      }

    } else {
      $error = 'File does not exist'; // set error
    }

    kill_because_error($error); // kill script with message error

  }


  function decode_json($json) {
    $decoded_json = json_decode($json, True); // decode json
    check_json();         // check if json is valid
    return $decoded_json; // return decoded json
  }


  function check_json() {
    
    $error = NULL;
    // get json error
    switch (json_last_error()) { 
      case JSON_ERROR_NONE:
        return; // no error so return from function
      break;
      case JSON_ERROR_DEPTH:
        $error = 'Maximum stack depth exceeded';
      break;
      case JSON_ERROR_STATE_MISMATCH:
        $error = 'Underflow or the modes mismatch';
      break;
      case JSON_ERROR_CTRL_CHAR:
        $error = 'Unexpected control character found';
      break;
      case JSON_ERROR_SYNTAX:
        $error = 'Syntax error, malformed JSON';
      break;
      case JSON_ERROR_UTF8:
        $error = 'Malformed UTF-8 characters, possibly incorrectly encoded';
      break;
      default:
        $error = 'Unknown error';
      break;
    }
    
    kill_because_error($error); // kill script with message error
    
  }

  function kill_because_error($message) {
    die($message); // terminate script and display message
  }

  function delete_employee($employee_to_delete) {
    $json_file = 'employees-final.json'; // name of file containing employee data
    $json = load_file($json_file);       // load file
    $employee_data = decode_json($json); // decode json
    $new_data = array();

    foreach($employee_data as $employee) {          // iterate through employees
      if ($employee['id'] != $employee_to_delete) { // if id of employee does not equal the id of the employee to delete
        array_push($new_data, $employee);           // add to new_data array
      }
    }

    $file = fopen($json_file, 'w');                           // open file in write mode
    fwrite($file, json_encode($new_data, JSON_PRETTY_PRINT)); // write new data to file
    fclose($file);                                            // close file
  }

  function update_employee_json($edited_employee) {
    $json_file = 'employees-final.json'; // name of file containing employee data
    $json = load_file($json_file);       // load file
    $employee_data = decode_json($json); // decode json
    $new_data = array();

    foreach($employee_data as $employee) {
      if ($employee['id'] == $edited_employee['id']) { // if id of employee equals the id of the employee to update 
        array_push($new_data, $edited_employee);       // add the edited employee to new_data array
      } else {                                         // else
        array_push($new_data, $employee);              // add original emplyee to new_data array
      }
    }

    $file = fopen($json_file, 'w');                           // open file in write mode
    fwrite($file, json_encode($new_data, JSON_PRETTY_PRINT)); // write new data to file
    fclose($file);                                            // close file
  }

  function check_last_bracket($salary, $tax_brackets) {
    $last_tax_bracket = end($tax_brackets)['minsalary'];
    $in_last_bracket = false;
    if ($salary >= $last_tax_bracket) {
      $in_last_bracket = true;
    }
    return $in_last_bracket;
  }

  function check_company_car($company_car) {
    // check if employee has a company car
    if (strtolower($company_car) == 'y') {
      return true;
    } else { 
      return false;
    }
  }

  function check_gbp($currency) {
    // check if currency is GBP
    if (strtolower($currency) == 'gbp') {
      return true;
    } else {
      return false;
    }
  }

  function get_currency_symbol($currency) {
    if (strtolower($currency) == 'gbp') {
      return '£';
    } elseif (strtolower($currency) == 'usd') {
      return '$';
    } else {
      return $currency;
    }
  }

  function update_max_salary($in_last_bracket, $has_company_car, $max_salary) {
    if ($has_company_car) {
      $max_salary = 0;
    } elseif ($in_last_bracket) {
      $max_salary /= 2;
    }
    return $max_salary;
  }

  function update_min_salary($in_last_bracket, $has_company_car, $min_salary) {
    if ($has_company_car) {
      $min_salary = 0;
    } elseif ($in_last_bracket) {
      $min_salary /= 2;
    }
    return $min_salary;
  }

  function calc_total($salary, $tax_brackets, $currency, $company_car) {
    $pay_data = array('tax'=>0, 'take_home'=>0);

    if (!check_gbp($currency)) {        // check currency is GBP
      $pay_data['take_home'] = $salary; // if false, return salary
      return $pay_data;
    }

    $in_last_bracket = check_last_bracket($salary, $tax_brackets); // check if salary is in last bracket
    $has_company_car = check_company_car($company_car); // check employee has a company car
    $bracket_num = 1;
    $total = 0;
    $tax = 0;

    foreach($tax_brackets as $bracket) { // iterate through tax brackets
      $max_salary = $bracket['maxsalary']; // set min salary
      $min_salary = $bracket['minsalary']; // set max salary
      $rate = $bracket['rate'] / 100; // convert percentage to decimal

      if ($bracket_num == 1) { 
        $max_salary = update_max_salary($in_last_bracket, $has_company_car, $max_salary);
      } elseif ($bracket_num == 2) {
        $min_salary = update_min_salary($in_last_bracket, $has_company_car, $min_salary);
      }

      $difference = $max_salary - $min_salary;

      if ($difference >= $salary) {
        $tax_for_bracket = $salary * $rate;
        $tax += $tax_for_bracket;
        $total += $salary - $tax_for_bracket;
        break;
      } else {
        $tax_for_bracket = $difference * $rate;
        $tax += $tax_for_bracket;
        $total += $difference - $tax_for_bracket;
        $salary -= $difference;
      }
      $bracket_num += 1;
    }

    $pay_data['tax'] = number_format($tax, 2);
    $pay_data['take_home'] = number_format($total, 2);
    return $pay_data;
  }

?>