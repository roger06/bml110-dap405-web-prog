
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <Link rel="stylesheet" href="styles/stylesheet.css" type = "text/css"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page</title>
</head>
<body>
    
    <?php
        
        include "LoginAuthenticator.php";
        session_start();

        $savedSession= $_SESSION;
        
        
        $pageUser = $savedSession["USER"];
        if($pageUser->PermisionLevel != "Administrator"){
            header("Location: LoginPage.php?Error=permision");
            exit;
        }
        
    ?>
<section class= "wrapper" >
<div id="userpage" >    
    <div class="row first " id ="lineunder" >
        <div class= "col-2"></div>
        <h2 class= " col-8 align-self-middle">Admin Page</h2>
        <a href="Logout.php" class="btn btn-info align-self-end col-2"> Logout</a>
    </div>
    <div class = "second row  mt-5 " id ="linktotable">
        <div class="col-6">
        <a href="EmployeeList.php" class="btn btn-info "> employees Table</a>
        </div>
    <div class="col-6  " id="uploader" >
        <!--file upload form-->
    <form action="NewFileUpload.php" method="post" enctype="multipart/form-data">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Upload</span>
            </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="employeedata" id="EmployeeData">
                    <label class="custom-file-label" for="EmployeeData">Employee Data file</label>
                </div>
    </div>
    <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text">Upload</span>
            </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="taxdatas" id="TaxData">
                    <label class="custom-file-label" for="TaxData">Tax Data file</label>
                </div>
    </div>
            <input type="submit" value="Upload new data" class="btn btn-primary">
        
    </form>
        
    </div>
    
    </div>
</div
</section>

</body>

</html>