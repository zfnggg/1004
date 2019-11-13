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
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>-->
        <link href="css/main.css" rel="stylesheet" />
        <link href="css/registration.css" rel="stylesheet" />
        <!-- Own CSS Style Sheet-->
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
        <!-- Font Awesome Icons -->
        <script defer src="js/main.js"></script>
        <!-- Own Javascript -->
    </head>

    <body>
        <!-- Start of Navigation Bar -->
        <div id="nav-placeholder">
            <script>
                $(function () {
                    $("#nav-placeholder").load("navbaruser.php");
                });
            </script>
        </div>
        <!--end of Navigation bar-->

        <div>
            <div class="jumbotron text-center bg-light">               
                <?php
                session_start();
                $_SESSION = array();
                session_unset();
                session_destroy();
                echo "You've successfully logged out! "
                ?>
                <p>Click here to <a href="./index.php">return to the main page</a></p>
            </div>

            <img src="img/bookroom1.jpg" class="mx-auto d-block img-fluid shrinkImageFam" alt="">
        </div>            <!--Footer-->
        <div id="footer-placeholder">
            <script>
                $(function () {
                    $("#footer-placeholder").load("footer.php");
                });
            </script>
        </div>
        <!--end of Footer-->
    </body>
</html>