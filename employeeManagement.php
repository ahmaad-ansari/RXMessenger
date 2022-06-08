<?php
    // Start new or resume existing session
    session_start();

    require('employeeManagementAPI.php');
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
<body>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="dashboard.php">
                                <span data-feather="home" class="align-text-bottom"></span>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="patientInfo.php">
                                <span data-feather="users" class="align-text-bottom"></span>
                                Patient Information
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="employeeManagement.php">
                                <span data-feather="folder" class="align-text-bottom"></span>
                                Employee Management
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">
                                <span data-feather="log-out" class="align-text-bottom"></span>
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h5"><span data-feather="folder" class=""></span> Employee Management</h1>
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
                        registerEmployee($fName, $lName, $username, $password, $role, $company);
                    }
                ?>


                <h6 class="bg-secondary p-3 text-white d-flex justify-content-between">
                    Register Profile
                    <button type="button" class="btn btn-light btn-xsm" data-bs-toggle="modal" data-bs-target="#registerEmployee"  style="--bs-btn-padding-y: 0rem; --bs-btn-padding-x: .25rem; --bs-btn-font-size: .75rem;">?</button>
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
                    Registered Profiles
                    <button type="button" class="btn btn-light btn-xsm" data-bs-toggle="modal" data-bs-target="#patientProfilesModal"  style="--bs-btn-padding-y: 0rem; --bs-btn-padding-x: .25rem; --bs-btn-font-size: .75rem;">?</button>
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $employeeInformation = getEmployeeInformation();
                                
                                // loops through all the arrays within the data array
                                foreach($employeeInformation['data'] as $sub_array){
                                    // prints table row for each registered user
                                    echo('
                                    <tr>
                                        <td class="row-data">'.$sub_array['fName'].'</td>
                                        <td class="row-data">'.$sub_array['lName'].'</td>
                                        <td class="row-data">'.$sub_array['username'].'</td>
                                        <td class="row-data">'.$sub_array['role'].'</td>
                                    </tr>
                                    ');
                                }
                            ?>
                        </tbody>
                    </table>
                </div>

            </main>

            <!-- INSTRUCTION MODALS -->
            <div class="modal fade" id="registerEmployee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLabel">All Patients</h5>
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
</script>