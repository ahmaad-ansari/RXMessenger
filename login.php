<?php
    // Start new or resume existing session
    session_start();

    require('loginAPI.php');
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
    <link href="css/signin.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
</head>

<!-- Defined SVG for alerts -->
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
    </symbol>
    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
    </symbol>
    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
    </symbol>
</svg>

<body>
    <main class="form-signin w-100 m-auto text-center">
        <!-- Change form method back to post once authentication is set up -->
        <form id="login" method="POST" enctype="multipart/form-data">
            <img class="mb-1" src="images/rx-logo.png" alt="" width="" height="100">
            <!-- <h1 class="h4 mb-3 fw-normal">Login</h1> -->
            <div class="form-floating mb-1">
                <input type="text" class="form-control" id="username" name="username" placeholder="placeholder" required>
                <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="password" name="password" placeholder="placeholder" required>
                <label for="floatingPassword">Password</label>
            </div>
            <input type="submit" class="w-100 btn btn-lg btn-primary" value="Login" name="login">
        </form>

        <?php
            if(isset($_POST['login'])){
                // stores the entered username and password into corresponding variables
                $username = htmlentities($_POST['username']);
                $password = htmlentities($_POST['password']);

                // sends the variables to the login function which processes the data via an API call
                login($username, $password);

            }
        ?>

        <script type = "text/javascript">
            var date = new Date();
            document.write("<p class='mt-5 mb-3 text-muted'>RXMessenger " + date.getFullYear() + " &copy;</p>"); 
        </script>
    </main>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>
