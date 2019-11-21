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
        <section class="container-registration text-center">
            <h1>Registration</h1>
            <p>Please fill in this form to create an account.</p>
            <hr>
            <form action="process_registration.php" method="post" name="formRegister" onsubmit="return validateRegistration()">
                <label for="name">Name:</label>
                <input type="text" id="name" name="customerName" required pattern="^(?=.{1,40}$)[a-zA-Z]+(?:[-'\s][a-zA-Z]+)*$">

                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required pattern="^(?=.{1,40}$)[a-zA-Z]+(?:[-'\s][a-zA-Z]+)*$">

                <label for="password">Password:</label>
                <input type="password" id="password" autocomplete="new-password" name="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,30}">

                <label for="cfmpassword">Confirm Password:</label>
                <input type="password" id="cfmpassword" autocomplete="new-password" name="confirmPassword" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">

                <label for="phone">Phone No:</label>
                <input type="text" id="phone" name="phoneNo" required pattern="[6,8,9][0-9]{7}">

                <label for="profilePic">Profile Picture:</label>
                <input type="file" name="profilePicture" id="profilePic" required accept=".png,.gif,.jpg,.webp">

                <input type="hidden" name="role" value="C">
                <input type="hidden" name="_token" value="<?php echo $_SESSION['_token'] ?>">

                <hr>
                <p>By creating an account you agree to our <a href="./tnp.php">Terms & Privacy</a>.</p>

                <input type="submit" name="submit" value="Register" class="registerbtn-registration"></input>
                <br />
            </form>
        </section>

        <div class="container-registration signin-registration">
            <p>Already have an account? <a href="./login.php">Sign in</a>.</p>
        </div>

    </main>

    <?php
    include "./footer.php";
    ?>

</body>

</html>