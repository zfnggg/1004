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

    <header>
        <?php
        session_start();

        $logMsg = $logout = "";

        if (isset($_SESSION['logout']))
        {
            $logOut = ($_SESSION['logout']);
            if ($logOut == "1" ) 
            {
                $logMsg = "You have been automatically logged out for being inactive for more than 15 minutes!";
            }
        }

        else
        {
            $logMsg = "You have successfully logged out!";
        }

        setcookie(session_name(), '', 100);
        session_unset();
        session_destroy();
        $_SESSION = array();

        include "./navbaruser.php";
        ?>
    </header>


    <main>
        <div class="jumbotron text-center bg-light">
            <?php
                echo $logMsg;
            ?>
            <p>Click here to <a href="./index.php">return to the main page</a></p>
        </div>

        <img src="img/bookroom1.jpg" class="mx-auto d-block img-fluid shrinkImageFam" alt="backgroundimg">
        <figcaption>Photo from Pixabay.com</figcaption>
    </main>

    <?php
    include "./footer.php";
    ?>

</body>

</html>