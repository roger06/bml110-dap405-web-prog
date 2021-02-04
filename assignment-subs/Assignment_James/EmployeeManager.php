<?php
include "ConfigurationManager.php";
interface IManager{
function updateTax($taxData);
function updateEmployees($employeeData);
function CalculateTax($employee);


    


}


class EmployeeManager implements IManager{
//create class employee manager
public array $TaxData;
public array $Employees;
public CompleteConfig $configData;
public User $AuthenticatedUser;
function __construct(CompleteConfig $configdata)
    {
        //get file locations from config
    $this->configData =$configdata;
    $this->Employees = $this->objectJsonFile($this->configData->configOptions["employeedata"]);
    $this->TaxData = $this->objectJsonFile($this->configData->configOptions["taxdata"]);
    }
    
//read json file data and save as array of objects
private function objectJsonFile($toConvert){
    $jsonData = file_get_contents($toConvert) or die ("Cannot accses file {$toConvert}");
    $jsonDataList = json_decode($jsonData);
    return $jsonDataList;
}
//update both employee and tax data
public function DataUpdate(){
    $this->TaxData = $this->objectJsonFile($this->configData->configOptions["employeedata"]);
    $this->Employees = $this->objectJsonFile($this->configData->configOptions["taxdata"]);
}
//update employee data only
public function updateEmployees($employeeData){
    $this->Employee = $this->objectJsonFile($employeeData);
}
//update Tax data only
public function updateTax($taxData){
    $this->TaxData = $this->objectJsonFile($taxData);
}

//calculate a specific employees tax
public function CalculateTax( $employee){
    
    $tax=0;
    $taxDataList = $this->TaxData;
  //deduct tax in each band
    $salaryLeft=0;
    foreach($taxDataList as $taxBand){
        
        if ($employee->salary >= $taxBand->maxsalary){
           $tax+= ($taxBand->maxsalary - ($taxBand->minsalary-0.01)) * ($taxBand->rate/100); 
        } 
        else{
            //get last tax band for further reductions
            $band=$taxBand->id;
            $tax += $salaryLeft * ($taxBand->rate/100);
        break;
        }
        $salaryLeft =  $employee->salary -$taxBand->maxsalary;

        
    }

    //workout reductions Company car and/or in highest tax band.
    if ($employee->salary<$taxDataList[0]->maxsalary){
        $taxfree = $employee->salary;
    }
    else{
    $taxfree = $taxDataList[0]->maxsalary;
    }
    if ($employee->salary > end($taxDataList)->maxsalary){
        $taxfree = $taxfree/2;
        $tax+= $taxfree * ($taxDataList[$band-1]->rate/100);

    }  
    if ($employee->companycar=="y"){
        $tax+= $taxfree * ($taxDataList[$band-1]->rate/100);

    }
    return $tax;
}
}


?>

