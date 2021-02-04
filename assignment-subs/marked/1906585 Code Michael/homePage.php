<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        body {
            text-align: center;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            background-color: whitesmoke;
            color: #313639;
        }

        .Container{
			width:80%;
			margin:auto;
            text-align: center;
		}

        .btn-success{
            border-color: black !important;
        }
    </style>
</head>

<body>
    <?php
        require_once('Menu.php');
        $LoginCheck = 0;
    ?>
<div class="Container">
    <form id="form2" action="EmployeePayslip.php" method="POST">
        <?php
            include_once('Functions.php');

            if (!isset($_SESSION)){
                if (!empty($_POST["txtPassword"])){
                    $Password = $_POST["txtPassword"];
                } else{
                    $Password = null;
                }

                if (!empty($_POST["txtUserName"])){
                    $UserName = $_POST["txtUserName"];
                } else{
                    $UserName = null;
                }

                if (($Password === 'Password1' and $UserName === 'User1') Or ($Password === 'AdminPassword' and $UserName = 'Admin')){ //or $_SESSION['Login'] == "Logged"){                
                    if (!isset($_SESSION)){
                        session_start();
                    }
                    HandleSessionVars("Start", "Login", "Logged");
                } else{
                    $LoginCheck += 1;
                }
            } else{
                $LoginCheck += 1;
            }
            if (!isset($_SESSION)){
                session_start();
            }
            

            if (!isset($_SESSION['Login'])) {
                $LoginCheck += 1;
            }
            
            if ($LoginCheck >= 2){
                echo "<br><br>Sorry That is the wrong password.<br><br><br><br>";
                echo "<a type='button' class='btn btn-outline-danger' href='login.php' >Return To Login Page</a>";
                   die();
            }

        ?>
        <h3 class="h3 display-4">Welcome!</h3>
        <div>
            <table class="table table-striped table-hover table-bordered">
                <thead class="">
                    <td>
                        ID
                    </td>
                    <td>
                        First Name
                    </td>
                    <td>
                        Last Name
                    </td>
                    <td>
                        Gross Annual Salary
                    </td>
                    <td>
                        Net Monthly Salary
                    </td>
                    <td>
                        Tax Paid Monthly
                    </td>
                    <td>
                        To Employee
                    </td>
                </thead>
                <?php
                    $Columns = array(0=>"id", 1=>"firstname", 2=>"lastname",3=>"salary", 4=>"netsalary", 5=>"taxpaid");
                    $FileData = GetJsonData("employees-final.json");
                    IterateArray($FileData, $Columns);//calls function to retrieve employee information.
                ?>
            </table>
        </div>
    </form>
</body>
</html>