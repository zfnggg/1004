<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">

<head>
    <title>D'Hotel</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Third Party CSS -->
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="shortcut icon" type="image/icon" href="./img/favicon.ico" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Personal Style Sheet & JS-->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script defer src="js/main.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link href="css/forgetpassword.css" rel="stylesheet" />
    <link href="css/main.css" rel="stylesheet" />
</head>

<body>

    <header>
        <?php
        include("./navbaruser.php");
        
        //CRF Token 
        $_SESSION['_token'] = bin2hex(openssl_random_pseudo_bytes(16));

        //Expire the session if user is inactive for 30
        //minutes or more.
        $expireAfter = 30;

        //Check to see if our "last action" session
        //variable has been set.
        if (isset($_SESSION['last_action'])) {

            //Figure out how many seconds have passed
            //since the user was last active.
            $secondsInactive = time() - $_SESSION['last_action'];

            //Convert our minutes into seconds.
            $expireAfterSeconds = $expireAfter * 60;

            //Check to see if they have been inactive for too long.
            if ($secondsInactive >= $expireAfterSeconds) {
                //User has been inactive for too long.
                //Kill their session.
                session_unset();
                session_destroy();
            }
        }

        //Assign the current timestamp as the user's
        //latest activity
        $_SESSION['last_action'] = time();
        ?>
    </header>

    <!-- onsubmit="return validateLoginForm()" -->
    <section class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>Login</h3>
                <form action="checklogin.php" method="post" name="formlogin" novalidate>

                    <label for="username">Username</label>
                    <input type="text" id="username" placeholder="Username" name="username" required pattern="(?=.{1,40}$)[a-zA-Z]+(?:[-'\s][a-zA-Z]+)*$">

                    <label for="password">Password</label>
                    <input type="password" id="password" placeholder="Password" name="password" autocomplete="current-password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,30}$">

                    <div class="elem-group">
                        <label for="captcha">Please Enter the Captcha Text</label>
                        <img src="captcha.php" id="captcha-image" alt="CAPTCHA" class="captcha-image"><i class="fas fa-redo refresh-captcha"></i>
                        <br>

                        <label for="captcha">Captcha</label>
                        <input type="text" id="captcha" placeholder="Captcha" name="captcha" required>

                        <input type="hidden" name="_token" value="<?php echo $_SESSION['_token'] ?>">
                    </div>

                    <button id="btn1" name="submit" type="submit">Login</button>

                </form>

                <p class="a"> <a href="#" onclick="document.getElementById('id01').style.display = 'block'" style="width:auto;">Forget Password</a></p>
                <noscript>
                    Your Javascript is currently not working, kindly enable your JavaScript.<br>
                    If you are unable to turn on the Javascript, please kindly use the link below: <br>
                    <a href="forgetpassword.php">Forget Password</a>
                    <link href="css/noscript.css" rel="stylesheet" />
                </noscript>
            </div>

            <aside class="col-md-6">
                <h3>Haven't Sign Up!</h3>
                <p>You can click here to sign up!</p>
                <a href="./registration.php">Become our member!</a>
            </aside>

        </div>
    </section>

    <div id="id01" class="modal">
        <span onclick="document.getElementById('id01').style.display = 'none'" class="close" title="Close Modal">&times;</span>
        <form action="checkforgetpassword.php" method="post" name="formforgetpass" class="modal-content" onsubmit="return validateForgetPasswordForm()" novalidate>
            <div class="container">
                <h1>Forget Password</h1>
                <p>Please fill in this form to get a new password.</p>
                <hr>
                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter Email" name="email" id="email" required>
                <p>We send you a email to restart your password. </p>
                <div class="clearfix">
                    <button type="button" onclick="myFunction()" class="cancelbtn">Cancel</button>
                    <button name="submit" type="submit" class="sendemailbtn">Send Email</button>
                </div>
            </div>
        </form>
    </div>

    <?php
    include_once("./footer.php");
    ?>

    <script>
        // Get the modal
        var modal = document.getElementById('id01');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target === modal) {
                modal.style.display = "none";
                document.getElementById('email').value = "";
            }
        };

        function myFunction() {
            document.getElementById('id01').style.display = 'none';
            document.getElementById('email').value = "";
        }

        function init() {
            document.getElementById("email").value = "";
            document.getElementById("username").value = "";
        }
        window.onload = init;

        var refreshButton = document.querySelector(".refresh-captcha");
        refreshButton.onclick = function() {
            document.querySelector(".captcha-image").src = 'captcha.php?' + Date.now();
        }
    </script>
</body>

</html>