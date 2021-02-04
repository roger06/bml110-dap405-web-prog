<?php

//this class would you use a Database for authentication
//to mock the solution We have set some simple rules for authentication
//Administrator Logs into admin page
//userx logs into employee with ID: x

include "launch.php";
include "User.php";
class LoginAuthenticator{
    
    
    public function __construct(IManager $EmpManager){
      $this->Manager = $EmpManager;
    }
    private EmployeeManager $manager;

    //find user in JSOn Data
    private function GetEmployeeObj($id){
        //could change employee data to be dynamic set from admin page
        
        $employeeList = $this->Manager->Employees;
        $id=intval($id);
        //really ineficient to find user form id
        $employeeFound=null;
        foreach($employeeList as $employee){
           echo $employee->id;
            if ($employee->id == $id){
            $employeeFound =$employee;    
            break;
            }   
        }
        return $employeeFound;
    }
    //Authenticate user 
    public function AuthenticateUser($UserName, $Password){
       $AttemptingUser = new User();
       //Check if adminsitrator
        if($UserName== "Administrator" AND $Password == "Password"){
            $AttemptingUser->id = 0;
            $AttemptingUser->UserName = "Admin";
            $AttemptingUser-> PermisionLevel = "Administrator";
            $usersTax=$this->Manager->CalculateTax($AttemptingUser->Data);

        }
        //if is a user type
        else if (substr($UserName,0,4)=="User" AND $Password == "Password" And ($this->GetEmployeeObj(substr($UserName,4)))!=null ) {
            
            $AttemptingUser -> UserName =  $UserName;
            $AttemptingUser-> PermisionLevel = "User";
            $AttemptingUser->Data = $this->GetEmployeeObj(substr($UserName,4));

            $AttemptingUser->tax= $this->Manager->CalculateTax($AttemptingUser->Data);
            $this->Manager = $AttemptingUser;
        }
        //user not found
        else{
            $AttemptingUser->PermisionLevel = "null";
            return $AttemptingUser;
        }

        return $AttemptingUser;  
    }

}

?>
