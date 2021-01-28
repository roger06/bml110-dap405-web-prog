
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <Link rel="stylesheet" href="styles/stylesheet.css" type = "text/css"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List page</title>
</head>
<body>
    
    <?php
        include "User.php";
        include "launch.php";
        
       session_start();

        $savedSession= $_SESSION;
        $Manager = $EmpManager;
        $employees= $Manager->Employees;
        //ensure user has acsess to page
        $pageUser = $savedSession["USER"];
        if ($pageUser->PermisionLevel!="Administrator"){
            header("Location: LoginPage.php?Error=permision");

        }

        
        
    ?>
    <section class= "wrapper" >
    <div id="listpage" >    
    <div class="row first mb-3 " id ="lineunder" >
        <a href="AdminPage.php" class="btn btn-info align-self-end col-2">Admin Page</a>
        <h2 class= " col-8 align-self-middle">Employee List</h2>
        <a href="Logout.php" class="btn btn-info align-self-end col-2"> Logout</a>
    </div>
    <div class="second table-responsive ">
        <table class="table table-hover table-striped">
        <thead class="thead-dark">      
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Salary</th>
            <th>Currency</th>
            <th>Pension</th>
            <th>Company Car</th>
            <th>Edit</th>

            </tr>
        </thead>    
            <?php foreach($employees as $employee):?>
             
            <tr>
                
                <td><?php  echo $employee->id?></td>
                <td><?php echo $employee->firstname?></td>  
                <td><?php echo $employee->lastname?></td>
                <td><?php echo "£{$employee->salary}"?></td>
                <td><?php echo $employee->currency?></td>
                <td><?php echo $employee->pension?></td>
                <td><?php echo $employee->companycar?></td>
                <td><a href="UserPage.php?id=<?php echo $employee->id?>">Veiw full Details</a></td>
            </tr>
             
            <?php endforeach;?>
        </table>
    </div>

</section>

</body>
</html>