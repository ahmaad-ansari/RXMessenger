<?php
    // Start new or resume existing session
    session_start();

    require __DIR__ . '/authentication.php';

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
                document.getElementById('dashboard').classList.add("active");
            </script>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h5"><span data-feather="home" class=""></span> Dashboard</h1>
                </div>
                
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <div class="col">
                        <h6 class="bg-secondary p-3 text-white m-0">Placeholder Heading</h6>
                        <div class="shadow p-3">
                            Content Filler.
                        </div>
                    </div>
                    <div class="col">
                        <h6 class="bg-secondary p-3 text-white m-0">Placeholder Heading</h6>
                        <div class="shadow p-3">
                            Content Filler.
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="js/dashboard.js"></script>

</body>
</html>