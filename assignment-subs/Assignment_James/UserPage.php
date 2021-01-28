<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>   
<Link rel="stylesheet" href="styles/stylesheet.css" type = "text/css"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user Page</title>
</head>
<body>
    
    <?php
    include "User.php";
        include "Launch.php";
               
        session_start();
        $savedSession= $_SESSION;
        $employeesList = $EmpManager->Employees;

        //ensure user has permisions and if it is an admin or a user.
        $pageUser= $_SESSION["USER"];
        $adminUser=null;
        if($pageUser->PermisionLevel=="Administrator"){
           $adminUser= $pageUser;
            $detailsarr= array_filter($employeesList,    
            function ($e) {
                $userid=intval( $_GET["id"]);
                return $e->id ==$userid;
            });
            $details = end($detailsarr);
        $pageUser= new User ();
        $pageUser->Data = $details;
        $pageUser->tax= $EmpManager->CalculateTax($details);
        $pageUser->UserName="Admin";
        $pageUser->PermisionLevel = "Administrator" ;             
        }

        else if ($pageUser->PermisionLevel!="User"){
            header("Location: LoginPage.php?Error=permision"); 
        }
        

        $UserDetails= $pageUser->Data;

    ?>
<section class= "wrapper" >
    <div id="listpage" >    
    <div class="row first mb-3 " id ="lineunder" >
        <?php if($adminUser!=null && $adminUser->PermisionLevel == "Administrator"):?>
        <a href="AdminPage.php" class="btn btn-info align-self-end col-2">Admin Page</a>
        <?php else:?>

        <div class= "col-2"></div>
        <?php endif;?>
        <h2 class= " col-8 align-self-middle"><?php echo  "{$UserDetails->firstname} {$UserDetails->lastname}"?></h2>
        <a href="Logout.php" class="btn btn-info align-self-end col-2"> Logout</a>
    </div>
    <div class="second table-responsive ">
    <table class="table table-hover table-striped ">
    <thead class="thead-dark">  
    <tr>
          <th>Field</th>
          <th>Info</th>
      </tr> 
    </thead> 
<?php
 foreach($UserDetails as $varName=>$property):
    if(gettype($property)=="array"){
        $property = join(", " ,$property);
    }
    
?>
<?php
//intercept loop to add calculated tax values 
if($varName == "salary"):
    $wage = $property/12;
    $monthTax= ($pageUser->tax)/12;
    $takeHomeMonth= $wage - $monthTax  
    ?>
        <tr> 
    <th><?php echo $varName?></th>
    <td><?php echo "£".round($property,2)?></td>
    </tr>
    <tr>
    <th><?php echo"wage"?></th>
    <td><?php echo "£".round($wage, 2) ?></th>
    </tr>
    
    <tr>
    <th><?php echo"TaxMonth"?></th>
    <td><?php echo "£".round($monthTax,2) ?></th>
    </tr> 
    <tr>
    <th><?php echo"Tax"?></th>
    <td><?php echo "£".round($pageUser->tax, 2) ?></th>
    </tr>   
    <tr>
    <th><?php echo"takehome"?></th>
    <td><?php echo "£".round($takeHomeMonth,2) ?></th>
    </tr>
    
<?php else:?>
    <tr> 
    <th><?php echo $varName?></th>
    <td><?php echo $property?></td>
    </tr>
 <?php endif;?>
<?php endforeach;?>
    </table>

   


    </div>

</section>

</body>
</html>