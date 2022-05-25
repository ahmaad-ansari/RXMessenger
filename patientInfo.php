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
                <li><a id="current-link" href="patientInfo.php">Patient Information</a></li>
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
                <a class="user-link" href="account.php">Ahmaad Ansari</a>
            </div>
        </header>

        <div class="cells">
            <div class="row">
                <div class="cell">
                    <div class="cell-header collapse">
                        <h2>Profiles</h2>
                        <h2 class="collapse-arrow">&#10095;</h2>
                    </div>
                    <div class="cell-content">
                        <table class="profiles">
                            <tr>
                                <th></th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Age</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr class="rowData">
                                <td><div id="user-profile"><h1>AA</h1></div></td>
                                <td>Ahmaad</td>
                                <td>Ansari</td>
                                <td>19</td>
                                <td>9054280000</td>
                                <td>placeholder@hotmail.com</td>
                                <td><a class="table-icon edit"><i class="fa-regular fa-edit"></i></a></td>
                                <td><a class="table-icon trash"><i class="fa-regular fa-trash-can"></i></a></td>
                            </tr>
                            <?php
                                for($i = 0; $i < 9; $i++){
                                    echo('
                                    <tr class="rowData">
                                        <td><div id="user-profile"><h1>AA</h1></div></td>
                                        <td>Ahmaad</td>
                                        <td>Ansari</td>
                                        <td>19</td>
                                        <td>9054280000</td>
                                        <td>placeholder@hotmail.com</td>
                                        <td><a class="table-icon edit"><i class="fa-regular fa-edit"></i></a></td>
                                        <td><a class="table-icon trash"><i class="fa-regular fa-trash-can"></i></a></td>
                                    </tr>
                                    ');
                                }
                            ?>
                            
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="cell">
                    <div class="cell-header collapse">
                        <h2>Scan New Profiles</h2>
                        <h2 class="collapse-arrow">&#10095;</h2>
                    </div>
                    <div class="cell-content">
                        Placeholder Message.
                    </div>
                </div>
                <div class="cell">
                    <div class="cell-header collapse">
                        <h2>Create New Profile</h2>
                        <h2 class="collapse-arrow">&#10095;</h2>
                    </div>
                    <div class="cell-content">
                        <form id="createProfile" method="POST" enctype="multipart/form-data">
                            <div class="formRow">
                                <div>   
                                    <label for="fName">First Name<span class="required">*</span></label>
                                    <input type="text" value="" name="fName" id="fName" required>
                                </div>    
                                <!-- <div>
                                    <label for="mName">Middle Name</label>
                                    <input type="text" value="" name="mName" id="mName">
                                </div> -->
                                <div>
                                    <label for="lName">Last Name<span class="required">*</span></label>
                                    <input type="text" value="" name="lName" id="lName" required>
                                </div>
                                <div>
                                    <label for="age">Age<span class="required">*</span></label>
                                    <input type="tel" value="" name="age" id="age" pattern="[0-9]{3}" required>
                                </div>
                            </div>
                            <div class="formRow">
                                <div>   
                                    <label for="phone">Phone Number<span class="required">*</span></label>
                                    <input type="tel" value="" name="phone" id="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
                                    <!-- Might have a problem later on with phone number entries for the user of the program -->
                                </div>    
                            </div>
                            <div class="formRow">   
                                <div>
                                    <label for="email">Email<span class="required">*</span></label>
                                    <input type="email" value="" name="email" id="email" required>
                                </div>
                            </div>
                            <input type="submit" class="submit" value="Create Profile" name="addProfile">
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
