<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" id="dashboard" aria-current="page" href="dashboard.php">
                    <span data-feather="home" class="align-text-bottom"></span>
                    Dashboard
                </a>
            </li>
            <?php
                if($_SESSION['USER_ROLE'] == "Admin"){
                    echo('
                    <li class="nav-item">
                        <a class="nav-link" id="employee" href="employees.php">
                            <span data-feather="folder" class="align-text-bottom"></span>
                            Employees
                        </a>
                    </li>
                    ');
                }
            ?>
            <li class="nav-item">
                <a class="nav-link" id="patient" href="patients.php">
                    <span data-feather="users" class="align-text-bottom"></span>
                    Patients
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="logout" href="login.php">
                    <span data-feather="log-out" class="align-text-bottom"></span>
                    Logout
                </a>
            </li>
        </ul>
    </div>
</nav>
