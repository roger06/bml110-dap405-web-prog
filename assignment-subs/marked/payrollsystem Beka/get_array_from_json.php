<!-- File for tax calculations and functions -->

<?php
$json = file_get_contents("employees-final.json") or die("Error");
$employees = json_decode($json, true);

function get_tax_detail_from_salary($salary, $detail)
{

    $taxjson = file_get_contents("tax-tables.json") or die("Error");
    $tax_bands = json_decode($taxjson, true);

    for ($i = 0; $i < 4; $i++) {
        if ($salary >= $tax_bands[$i]["minsalary"] && $salary <= $tax_bands[$i]["maxsalary"]) {
            $tax_index = $i;
        }
    }

    return $tax_bands[$tax_index][$detail];
}

function get_tax_detail_from_index($index, $detail)
{

    $taxjson = file_get_contents("tax-tables.json") or die("Error");
    $tax_bands = json_decode($taxjson, true);
    return $tax_bands[$index][$detail];
}

function calculate_tax($salary, $company_car, $currency): float
{

    $tax_deducted = 0;
    $taxable_salary = $salary;

    if ($currency != "GBP" | ($salary < 10000 && $company_car == "n")) {
        return $tax_deducted;
    }

    $tax_free_amount = get_tax_detail_from_index(0, "maxsalary");
    $taxable_running_total = 0;

    if ($salary >= get_tax_detail_from_index(3, "minsalary")) {
        $taxable_amount = $salary - get_tax_detail_from_index(3, "minsalary");
        $tax_deducted += (($taxable_amount / 100) * get_tax_detail_from_index(3, "rate"));
        /*$tax_deducted = round($tax_deducted,2);*/
        $taxable_running_total += $taxable_amount;
    }

    if ($salary >= get_tax_detail_from_index(2, "minsalary")) {
        $taxable_amount = $salary - $taxable_running_total - get_tax_detail_from_index(2, "minsalary");
        $tax_deducted += (($taxable_amount / 100) * get_tax_detail_from_index(2, "rate"));
        /*$tax_deducted = round($tax_deducted,2);*/
        $taxable_running_total += $taxable_amount;
    }

    if ($salary >= get_tax_detail_from_index(1, "minsalary")) {
        $taxable_amount = $salary - $taxable_running_total - get_tax_detail_from_index(1, "minsalary");
        if ($company_car == "y") {
            $taxable_amount += (get_tax_detail_from_index(0, "maxsalary"));
        } else if ($salary >= get_tax_detail_from_index(3, "minsalary")) {
            $taxable_amount += (get_tax_detail_from_index(0, "maxsalary") / 2);
        }
        $tax_deducted += (($taxable_amount / 100) * get_tax_detail_from_index(1, "rate"));
        /*$tax_deducted = round($tax_deducted,2);*/
        $taxable_running_total += $taxable_amount;
    }
    return $tax_deducted;
}
// End of tax calculation code


// List of functions

// To display correct currency symbol
function get_currency_symbol($currency)
{

    if ($currency == "EURO") {
        return "€";
    } else if ($currency == "USD") {
        return "$";
    } else {
        return "£";
    }
}

// To display and format address for payslips
function format_address($address)
{
    $address_arr = explode(',', $address);
    $output = "";
    for ($i = 0; $i < sizeof($address_arr); $i++) {
        $output .= $address_arr[$i] . "<br>";
    }
    return $output;
}

// To caculate months for payslip TYD section
function get_last_april()
{
    // first of April this year
    $april_this_year = date('Y-04-01');

    // current date
    $today = date('Y-m-d');

    // current year
    $year = date('Y');

    // if April in this year is yet to come   
    if ($april_this_year >= $today) {
        // then it was previous year
        --$year;
    }
    return date("$year-04-01");
}
?>