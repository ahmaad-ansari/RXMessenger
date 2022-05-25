<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css" type="text/css">
    <link rel="icon" href="images/thumbnail.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="script.js" async defer></script>
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
        </div>
        
        <nav>
            <ul class="dash-links">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="patientInfo.php">Patient Information</a></li>
                <li><a href="#">Employee Information</a></li>
                <li><a href="#">Manage Messages</a></li>
            </ul>
        </nav>

        <div id="logout">
            <button type="button" class="action-buttons" onclick="window.location.href='login.php'">
                <i class="fa fa-sign-out"></i> Log out
            </button>
        </div>
    </div>

    <div class="content">

        <header>
            <div class="headerLeft">
            <h4><span class="secondary">Pharma</span><span class="primary">Choice</span><span class="slim"> | Ajax ON</span></h4>
            </div>
            <div class="headerRight">
                <h4><span class="slim" id="greeting"></span></h4>
                <a class="user-link" id="current-link" href="account.php">Ahmaad Ansari</a>
            </div>
        </header>
        

        <div class="cells">
            <div class="row">
                <div class="cell">
                    <div class="cell-header">
                        <h2>Account Information</h2>
                    </div>
                    <div class="cell-content">
                        <!-- Fill in form values with exisiting user information from database -->
                        <form id="updateAccountInformation" method="POST" enctype="multipart/form-data">
                            <div class="formRow">
                                <div>   
                                    <label for="fName">First Name<span class="required">*</span></label>
                                    <input type="text" value="Ahmaad" name="fName" id="fName" required>
                                </div>
                            </div>
                            <div class="formRow">
                                <div>   
                                    <label for="lName">Last Name<span class="required">*</span></label>
                                    <input type="text" value="Ansari" name="lName" id="lName" required>
                                </div>
                            </div>
                            <div class="formRow">
                                <div>   
                                    <label for="password">Password<span class="required">*</span></label>
                                    <input type="password" value="placeholder" name="password" id="password" required>
                                </div>
                            </div>
                            <div class="formRow">
                                <div>   
                                    <label for="passwordReenter">Re-enter Password<span class="required">*</span></label>
                                    <input type="password" value="placeholder" name="passwordReenter" id="passwordReenter" required>
                                </div>
                            </div>
                            <input type="submit" class="submit" value="Save" name="save">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <footer>
            <h6>RX Messenger <?php echo date("Y");?> &copy</h6>
        </footer>
    </div>
</body>
</html>

<script>
    //=================================================================================================================
    // Toggles the visibility of dropdown menus
    //=================================================================================================================
    $(".collapse").click(function () {
        $header = $(this);
        //getting the next element
        $content = $header.next();
        //open up the content needed - toggle the slide- if visible, slide up, if not slidedown.
        $content.toggle(0, function(){
            if($content.is(":visible")){
                $header.css({
                    "border-radius": "10px 10px 0 0",
                    "background-color": "var(--primary)"
                });
            }
            else{
                $header.css({
                    "border-radius": "10px",
                    "background-color": "var(--tertiary)"
                });
            }
        });
    });
    //=================================================================================================================
</script>