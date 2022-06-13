<?php
    // Start new or resume existing session
    session_start();

    require __DIR__ . '/API Functions/API_employees.php';
    require __DIR__ . '/authentication.php';

    userHasAdminAccess();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>RXMessenger</title>
    <link rel="icon" href="images/thumbnail.png">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <!-- CSS Files for table sort and filter -->
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>
<body>

    <header class="navbar navbar-light sticky-top bg-light flex-md-nowrap p-0 shadow ">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="dashboard.php">RXMessenger</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap user-button bg-primary">
                <a class="nav-link px-3" href="account.php"><?php echo($_SESSION['USER_FNAME'] . " " . $_SESSION['USER_LNAME']); ?></a>
            </div>
        </div>
    </header>
    <div class="container-fluid">
        <div class="row">
            <!-- Loads the navigation bar -->
            <?php require('navigation.php'); ?>
            
            <script>
                // Sets the active link
                document.getElementById('employee').classList.add("active");
            </script>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h5"><span data-feather="folder" class=""></span> Employees</h1>
                </div>

                <?php
                    if(isset($_POST['registerEmployee'])){
                        // stores the entered values into corresponding variables
                        $fName = htmlentities($_POST['fName']);
                        $lName = htmlentities($_POST['lName']);
                        $username = htmlentities($_POST['username']);
                        $password = htmlentities($_POST['password']);
                        $role = htmlentities($_POST['role']);
                        $company = htmlentities($_POST['company']);                        
                        

                        // sends the variables to the registerEmployee function which processes the data via an API call
                        addUser($fName, $lName, $username, $password, $role, $company);
                    }

                    if(isset($_POST['editUserProfile'])){
                        // stores the entered values into corresponding variables
                        $fName = htmlentities($_POST['fNameEdit']);
                        $lName = htmlentities($_POST['lNameEdit']);
                        $username = htmlentities($_POST['usernameEdit']);
                        $role = htmlentities($_POST['roleEdit']);                 
                        $id = htmlentities($_POST['idEdit']);                        

                        editUser($id, $fName, $lName, $username, $role);
                    }
                    
                    if(isset($_POST['deleteUserProfile'])){
                        // stores the entered values into corresponding variables                        
                        $id = htmlentities($_POST['idDelete']);                        

                        deleteUser($id);
                    }
                ?>

                <h6 class="bg-secondary p-3 text-white d-flex justify-content-between">
                    Register Employee Profile
                    <button type="button" class="btn btn-light btn-xsm" data-bs-toggle="modal" data-bs-target="#registerEmployeeModal"  style="--bs-btn-padding-y: 0rem; --bs-btn-padding-x: .25rem; --bs-btn-font-size: .75rem;">?</button>
                </h6>
                <div class="mb-5 shadow p-3">
                    <!-- Change the form method to POST when authentication is setup -->
                    <form class="text-center" id="registerEmployee" method="POST">
                        <div class="row g-2 mb-2">
                            <div class="col-md">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="fName" maxlength="50" name="fName" required>
                                    <label for="fName">First Name</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="lName" maxlength="50" name="lName" required>
                                    <label for="lName">Last Name</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating">
                                    <select class="form-select" id="role" name="role" required>
                                        <option selected disabled hidden></option>
                                        <option value="Admin">Admin</option>
                                        <option value="Employee">Employee</option>
                                    </select>
                                    <label for="role">Choose a role</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="company" value="PharmaChoice" name="company" readonly="readonly">
                                    <label for="company">Company</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-2 mb-2">
                            <div class="col-md">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="username" minlength="5" maxlength="50" name="username" required>
                                    <label for="username">Username</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="password" minlength="8" maxlength="50" name="password" required>
                                    <label for="password">Password</label>
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-md btn-primary" value="Register Employee" name="registerEmployee">
                    </form>
                </div>

                <h6 class="bg-secondary p-3 text-white d-flex justify-content-between">
                    Registered Employee Profiles
                    <button type="button" class="btn btn-light btn-xsm" data-bs-toggle="modal" data-bs-target="#registeredEmployeesModal"  style="--bs-btn-padding-y: 0rem; --bs-btn-padding-x: .25rem; --bs-btn-font-size: .75rem;">?</button>
                </h6>
                <div class="mb-5 shadow p-3 table-responsive ">
                    <table class="table table-sm table-hover" id="employeeProfilesTable">
                        <!-- Code the program so that certain roles have access to certain tasks -->
                        <thead>
                            <tr>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Username</th>
                                <th scope="col">Role</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $employees = showAll();
                                // loops through all the arrays within the data array
                                // if($employees['success']){
                                foreach($employees['data'] as $sub_array){
                                    // prints table row for each registered user
                                    echo('
                                    <tr id="'.$sub_array['id'].'">
                                        <td class="row-data">'.$sub_array['fName'].'</td>
                                        <td class="row-data">'.$sub_array['lName'].'</td>
                                        <td class="row-data">'.$sub_array['username'].'</td>
                                        <td class="row-data">'.$sub_array['role'].'</td>
                                        <td class="row-data"><button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editProfileModal" style="--bs-btn-padding-y: 0rem; --bs-btn-padding-x: .25rem; --bs-btn-font-size: .75rem;" onclick="editUserProfile()">Edit</button></td>
                                        <td class="row-data"><button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteProfileModal" style="--bs-btn-padding-y: 0rem; --bs-btn-padding-x: .25rem; --bs-btn-font-size: .75rem;" onclick="deleteUserProfile()">Delete</button></td>
                                    </tr>
                                    ');
                                }
                                // }
                            ?>
                        </tbody>
                    </table>
                </div>

            </main>

            <!-- EDIT PROFILE MODAL -->
            <div class="modal fade" id="editProfileModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Edit Profile</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="text-center" id="editUserProfile" method="POST">
                                <div class="row g-2 mb-2">
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" id="idEdit" min="0" max="125" name="idEdit" readonly="readonly" required>
                                            <label for="idEdit">ID</label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="fNameEdit" maxlength="50" name="fNameEdit" required>
                                            <label for="fNameEdit">First Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="lNameEdit" maxlength="50" name="lNameEdit" required>
                                            <label for="lNameEdit">Last Name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-2 mb-2">
                                    
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="usernameEdit" maxlength="50" name="usernameEdit" required>
                                            <label for="usernameEdit">Username</label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <select class="form-select" id="roleEdit" name="roleEdit" required>
                                                <option selected disabled hidden></option>
                                                <option value="Admin">Admin</option>
                                                <option value="Employee">Employee</option>
                                            </select>
                                            <label for="roleEdit">Choose a role</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer p-1">
                                    <button type="button" class="btn btn-secondary y-0" data-bs-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-md btn-primary y-0" value="Update" name="editUserProfile">
                                </div>
                            </form>                    
                        </div>
                    </div>
                </div>
            </div>
            <!-- DELETE PROFILE MODAL -->
            <div class="modal fade" id="deleteProfileModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Delete Profile</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="text-center" id="deleteUserProfile" method="POST">
                            <div class="row g-2 mb-2">
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" id="idDelete" min="0" max="125" name="idDelete" readonly="readonly" required>
                                            <label for="idDelete">ID</label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="fNameDelete" maxlength="50" name="fNameDelete" disabled>
                                            <label for="fNameDelete">First Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="lNameDelete" maxlength="50" name="lNameDelete" disabled>
                                            <label for="lNameDelete">Last Name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-2 mb-2">
                                    
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="usernameDelete" maxlength="50" name="usernameDelete" disabled>
                                            <label for="usernameDelete">Username</label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="passwordDelete" maxlength="50" name="passwordDelete" disabled>
                                            <label for="passwordDelete">Password</label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <select class="form-select" id="roleDelete" name="roleDelete" disabled>
                                                <option selected disabled hidden></option>
                                                <option value="Admin">Admin</option>
                                                <option value="Employee">Employee</option>
                                            </select>
                                            <label for="roleDelete">Choose a role</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer p-1">
                                    <button type="button" class="btn btn-secondary y-0" data-bs-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-md btn-danger y-0" value="Delete" name="deleteUserProfile">
                                </div>
                            </form>                    
                        </div>
                    </div>
                </div>
            </div>

            <!-- INSTRUCTION MODALS -->
            <div class="modal fade" id="registerEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Register Employee Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6>Header</h6>
                        <ol>
                            <li>When <a role="button" class="btn btn-primary btn-sm" style="--bs-btn-padding-y: 0rem; --bs-btn-padding-x: .25rem; --bs-btn-font-size: .75rem;">Submit</a> is clicked then....</li>
                        </ol>                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="registeredEmployeesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Registered Employee Profiles</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6>Header</h6>
                        <ol>
                            <li>When <a role="button" class="btn btn-primary btn-sm" style="--bs-btn-padding-y: 0rem; --bs-btn-padding-x: .25rem; --bs-btn-font-size: .75rem;">Submit</a> is clicked then....</li>
                        </ol>                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="js/dashboard.js"></script>

    <!-- JavaScript for Table Filter and Sort -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

</body>
</html>

<script>
    $(document).ready(function () {
        $('#employeeProfilesTable').DataTable();
    });

    function editUserProfile(){
        //this gives id of tr whose button was clicked
        var rowId = event.target.parentNode.parentNode.id;
        
        /*returns array of all elements with "row-data" class within the row with given id*/
        var data = document.getElementById(rowId).querySelectorAll(".row-data"); 
        
        var fName = data[0].innerHTML;
        var lName = data[1].innerHTML;
        var username = data[2].innerHTML;
        var role = data[3].innerHTML;
        
        document.getElementById('idEdit').value = rowId;
        document.getElementById('fNameEdit').value = fName;
        document.getElementById('lNameEdit').value = lName;
        document.getElementById('usernameEdit').value = username;
        document.getElementById('roleEdit').value = role;
    }

    function deleteUserProfile(){
        //this gives id of tr whose button was clicked
        var rowId = event.target.parentNode.parentNode.id;
        
        /*returns array of all elements with "row-data" class within the row with given id*/
        var data = document.getElementById(rowId).querySelectorAll(".row-data"); 
        
        var fName = data[0].innerHTML;
        var lName = data[1].innerHTML;
        var username = data[2].innerHTMLs;
        var role = data[3].innerHTML;
        
        document.getElementById('idDelete').value = rowId;
        document.getElementById('fNameDelete').value = fName;
        document.getElementById('lNameDelete').value = lName;        
        document.getElementById('usernameDelete').value = username;
        document.getElementById('roleDelete').value = role;
    }
</script>