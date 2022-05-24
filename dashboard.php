<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css" type="text/css">
    <link rel="icon" href="images/thumbnail.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="" async defer></script>
</head>
<body>

    <div class="sidebar">
        <div class="logo-header">
            <h2 id="company-name">RX<span class="slim"> Messenger</span></h2>
            <h4 id="slogan"><i>"Sending reminders just got easier"</i></h4>
        </div>
        <div class="user-info">
            <div id="user-profile">
                <h1>AA</h1>
            </div>
            <h2 id="welcome-message"><span class="slim">Welcome</span> Ahmaad Ansari!</h2>
            <div class="badges">
                <!-- <img src="images/custom-company-logo.png" alt="logo"> -->
                <!-- <h4><span class="primary">Pharma</span><span class="secondary">Choice</span></h4> -->
            </div>
        </div>
        
        <nav>
            <ul class="dash-links">
                <li><a id="current-link" href="dashboard.php">Dashboard</a></li>
                <li><a href="#">Client Databases</a></li>
                <li><a href="#">Employee Information</a></li>
                <li><a href="#">Manage Messages</a></li>
                <li><a href="#">Link 5</a></li>
            </ul>
        </nav>

        <div id="logout">
            <button type="button" class="action-buttons">
                <i class="fa fa-sign-out"></i> Log out
            </button>
        </div>
    </div>

    <div class="content">
        <div class="row" id="mainRow">
            <div class="cell"><img src="images/custom-company-banner.png" alt="banner"></div>
        </div>
        <div class="row">
            <div class="cell"></div>
            <div class="cell"></div>
        </div>
        <div class="row">
            <div class="cell"></div>
        </div>
        <div class="row">
            <div class="cell"></div>
            <div class="cell"></div>
            <div class="cell"></div>
        </div>
        <footer>
            <h6>RX Messenger 2022 &copy</h6>
        </footer>
    </div>
</body>
</html>

