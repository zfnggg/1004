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
    <script type="text/javascript" src="js/purify.js"></script>
    <!-- Own Javascript -->
</head>

<body>

    <header>
        <?php
        include "./navbaruser.php";
        //    session_start();
        $_SESSION['_token'] = bin2hex(openssl_random_pseudo_bytes(16));
        ?>
    </header>

    <!-- Novalidate removes HTML-->
    <!-- onsubmit="return validateRegistration()" is for javascript_-->
    <!-- action="process_registration.php" method="post" for php-->

    <main>
        <form action="process_registration.php" method="post" name="formRegister" onsubmit="return validateRegistration()" novalidate>
            <div class="container-registration text-center">
                <h1>Registration</h1>
                <p>Please fill in this form to create an account.</p>
                <hr>
                <p>Name:
                    <input type="text" name="customerName" required pattern="^(?=.{1,40}$)[a-zA-Z]+(?:[-'\s][a-zA-Z]+)*$"> </p>
                <p>Username:
                    <input type="text" name="username" required pattern="^(?=.{1,40}$)[a-zA-Z]+(?:[-'\s][a-zA-Z]+)*$"> </p>
                <p>Password:
                    <input type="password" autocomplete="new-password" name="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,30}"> </p>
                <p>Confirm Password:
                    <input type="password" autocomplete="new-password" name="confirmPassword" required> </p>
                <p>Email:
                    <input type="email" name="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"> </p>
                <p>Phone No:
                    <input type="text" name="phoneNo" required pattern="[6,8,9][0-9]{7}"> </p>
                <input type="hidden" name="role" value="C">
                <p>Profile Picture:
                    <input type="file" name="profilePicture" id="profilePic" required accept=".png,.gif,.jpg,.webp"> </p>
                <hr>
                <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

                <input type="submit" name="submit" value="add" class="registerbtn-registration"></input>
                <br />
            </div>
            <div class="container-registration signin-registration">
                <p>Already have an account? <a href="./login.php">Sign in</a>.</p>
            </div>
        </form>
    </main>

    <?php
    include "./footer.php";
    ?>

</body>

</html>