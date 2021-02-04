<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <ul class="navbar-nav">
        <a class="navbar-brand" href="list.php">Payroll System </a>



        <?php
        
    
    if(isset($_SESSION['username'])){?>
        <!-- if session is set (so user is logged in)... -->


        <ul class="nav navbar-nav mr-auto"></ul>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">Log Out</a> <!-- display log out link -->

        </li>
    </ul>

    <ul class="ml-auto">

        <p class="nav-item" "mr-sm-2" style="color:white"> Admin <span class="sr-only">(current)</span></p>
    </ul>


    <?php 
                                                }
        
        else { ?>
    <!-- if user isn't logged in... -->


    <a class="nav-item nav-link" href="index.php"> Log In</a> <!-- display log in link -->


    <?php
            
        } // end else
        ?>


</nav>
