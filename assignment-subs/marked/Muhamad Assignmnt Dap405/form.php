
<div class="container">
    <div class="card">
    <div class="card-header">
        <?php if ($employeedata['id']): ?>  
                   <h3> Update user: <b><?php echo $employeedata['firstname']. $employeedata['lastname'] ?></b>  <!-- if the employee id exist and is right in the URL then the user information and record will be displayed their first name and sirname in the head. -->
                <?php else: ?>
                    Create new User  <!-- if the usreid is not correct or not there then it will be taken as a new employee and therefore will need to have empty fields which the user can use to add the employee data -->
                <?php endif ?> </h3>
        </div>

        <div class="card-body">
<!-- All the input fields will display the information about the employee based on the json data and employee data variable is use to pick the recorded data of each employee -->
<!-- error is  displayed is the given records names are invalid or doesn't exit this is to have more security and reliablity. -->       

            <form method="POST" action="">
                <div class="form-group">
                    <label>Employee Id: </label>
                    <input type="number" name="id" value="<?php echo $employeedata['id'] ?>"
                        class="form-control <?php echo $errors['id'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo  $errors['id'] ?>
                    </div>
                </div>

                <div class="form-group">
                    <label>First Name: </label>
                    <input name="firstname" value="<?php echo $employeedata['firstname'] ?>"
                        class="form-control <?php echo $errors['firstname'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo  $errors['firstname'] ?>
                    </div>
                </div>

                <div class="form-group">
                    <label>Last Name: </label>
                    <input name="lastname" value="<?php echo $employeedata['lastname'] ?>"
                           class="form-control <?php echo $errors['lastname'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo  $errors['lastname'] ?>
                    </div>
                </div>

                <div class="form-group">
                    <label>Job Title: </label>
                    <input name="jobtitle" value="<?php echo $employeedata['jobtitle'] ?>"
                           class="form-control <?php echo $errors['jobtitle'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo  $errors['jobtitle'] ?>
                    </div>
                </div>

                <div class="form-group">
                    <label>Department: </label>
                    <input name="department" value="<?php echo $employeedata['department'] ?>"
                           class="form-control <?php echo $errors['department'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo  $errors['department'] ?>
                    </div>
                </div>

                <div class="form-group">
                    <label>Line Manager: </label>
                    <input name="linemanager" value="<?php echo $employeedata['linemanager'] ?>"
                           class="form-control <?php echo $errors['linemanager'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo  $errors['linemanager'] ?>
                    </div>
                </div>

                <div class="form-group">
                    <label>Email: </label>
                    <input name="email" value="<?php echo $employeedata['email'] ?>"
                           class="form-control  <?php echo $errors['email'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo  $errors['email'] ?>
                    </div>
                </div>

                <div class="form-group">
                    <label>Phone: </label>
                    <input name="phone" value="<?php echo $employeedata['phone'] ?>"
                           class="form-control  <?php echo $errors['phone'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo  $errors['phone'] ?>
                    </div>
                </div>

                <div class="form-group">
                    <label>Salary: </label>
                    <input type="number" name="salary" value="<?php echo $employeedata['salary'] ?>"
                           class="form-control  <?php echo $errors['salary'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo  $errors['salary'] ?>
                    </div>
                </div>

                <div class="form-group">
                    <label>Date of Birth: </label>
                    <input name="dob" value="<?php echo $employeedata['dob'] ?>"
                           class="form-control  <?php echo $errors['dob'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo  $errors['dob'] ?>
                    </div>
                </div>

                <div class="form-group">
                    <label>Home Address: </label>
                    <input name="homeaddress" value="<?php echo $employeedata['homeaddress'] ?>"
                           class="form-control  <?php echo $errors['homeaddress'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo  $errors['homeaddress'] ?>
                    </div>
                </div>

                <div class="form-group">
                    <label>Pension:  </label>
                    <input name="pension" value="<?php echo $employeedata['pension'] ?>"
                           class="form-control <?php echo $errors['pension'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo  $errors['pension'] ?>
                    </div>
                </div>

                <div class="form-group">
                    <label>Company Car:  </label>
                    <input name="companycar" value="<?php echo $employeedata['companycar'] ?>"   
                           class="form-control <?php echo $errors['companycar'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo  $errors['companycar'] ?>
                    </div>
                </div>

                <button class="btn btn-success">Submit</button>
                <a class="btn btn-danger" href="index.php">Cancel</a>
            </form>
        </div>
    </div>
</div>
