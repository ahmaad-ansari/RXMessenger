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

    <div class="sidebar" id="login-page">
        <div class="logo-header rotate-login">
            <h2 id="company-name">RX<span class="slim"> Messenger</span></h2>
        </div>
    </div>

    <div class="content">

        <header>
            <div class="headerLeft">
            <h4><span class="secondary">Pharma</span><span class="primary">Choice</span><span class="slim"> | Ajax ON</span></h4>
            </div>
        </header>
        

        <div class="cells">
            <div class="row">
                <div class="cell">
                    <div class="cell-header">
                        <h2>Login</h2>
                    </div>
                    <div class="cell-content">
                        <!-- Add required inputs back in after login can be authorized from the backend -->
                        <form id="login" method="POST" enctype="multipart/form-data" action="dashboard.php">
                            <div class="formRow">
                                <div>   
                                    <label for="username">Username<span class="required">*</span></label>
                                    <input type="text" value="" name="username" id="username">
                                </div>
                            </div>
                            <div class="formRow">
                                <div>   
                                    <label for="password">Password<span class="required">*</span></label>
                                    <input type="password" value="" name="password" id="password">
                                </div>
                            </div>
                            <input type="submit" class="submit" value="Login" name="login">
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
