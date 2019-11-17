<?php

include "./navbaruser.php";

?>
<html>
    <head>
        <title>D'Hotel</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/icon" href="./img/favicon.ico"/>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <link href="css/forgetpassword.css" rel="stylesheet" />
        <link href="css/main.css" rel="stylesheet" />
        <!-- Own CSS Style Sheet-->
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
        <!-- Font Awesome Icons -->
        <script defer src="js/main.js"></script>
        <!-- Own Javascript -->
    </head>
    <body>
    
         <form action="checkforgetpassword.php" method="post" name="formforgetpass" class="modal-content" onsubmit="return validateForgetPasswordForm()" novalidate>
                <div class="container">
                    <h1>Forget Password</h1>
                    <p>Please fill in this form to get a new password.</p>
                    <hr>
                    <label for="email"><b>Email</b></label>
                    <input type="text" placeholder="Enter Email" name="email" id="email" required>
                    <p>We send you a email to restart your password. </p>
                    <div class="clearfix">
                        <button name="submit" type="submit"  class="sendemailbtn1">Send Email</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
        <?php
    include "./footer.php";
    ?>
</html>
    