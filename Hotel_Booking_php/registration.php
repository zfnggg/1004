<?php
    include "./navbaruser.php";
//    session_start();
    $_SESSION['_token'] = bin2hex(openssl_random_pseudo_bytes(16));
?>

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
        <script src="js/purify.js"></script>
        <!-- Own Javascript -->
    </head>

    <body>

        <form action="process_registration.php" method="post">
            <div class="container-registration text-center">
                <h1>Registration</h1>
                <p>Please fill in this form to create an account.</p>
                <hr>
                <p>Name:
                    <input type="text" name="customerName"> </p>
                <p>Username:
                    <input type="text" name="username"> </p>
                <p>Password:
                    <input type="password" autocomplete="new-password" name="password"> </p>
                <p>Confirm Password:
                    <input type="password" autocomplete="new-password" name="confirmPassword"> </p>
                <p>Email:
                    <input type="email" name="email"> </p>
                <p>Phone No:
                    <input type="text" name="phoneNo"> </p>
                <input type="hidden" name="role" value="C"> 
                <p>Profile Picture:
                    <input type="file" name="profilePicture"> </p>
                <hr>
                <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

                <input type="submit" name="submit" value="add" class="registerbtn-registration" onclick="myFunction()"></input>
                <br/>            
            </div>
            <div class="container-registration signin-registration">
                <p>Already have an account? <a href="./login.php">Sign in</a>.</p>
            </div>
        </form>

        <script>
            function myFunction() {

                var customerName = document.forms["addcustomer"]["customerName"];
                var username = document.forms["addcustomer"]["username"];
                var email = document.forms["addcustomer"]["email"];
                var regexEmail = /\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/;
                var password = document.forms["addcustomer"]["password"];
                var confirmpwd = document.forms["addcustomer"]["confirmPassword"];
                var phoneNo = document.forms["addcustomer"]["phoneNo"];
                
                var profilepic = document.forms["addcustomer"]["profilePicture"];

                //Sanitize input using an exernal javascript library called DOMPurify. Source:https://github.com/cure53/DOMPurify
                //Prevents XSS attacks
                customerName = DOMPurify.sanitize(customerName);
                username = DOMPurify.sanitize(username);
                email = DOMPurify.sanitize(email);
                password = DOMPurify.sanitize(password);
                confirmpwd = DOMPurify.sanitize(confirmpwd);
                phoneNo = DOMPurify.sanitize(phoneNo);


                if (customerName.value === "")
                {
                    window.alert("Please enter  name.");

                    return false;
                }

                if (username.value === "")
                {
                    window.alert("Please enter username.");

                    return false;
                }
                if (phoneNo.value === "")
                {
                    window.alert("Please enter phone number.");

                    return false;
                }
                
                if (profilepic.value === "")
                {
                    window.alert("Please upload profile picture.");

                    return false;
                }

                if (email.value === "")
                {
                    window.alert("Please enter a valid e-mail address.");

                    return false;
                } else if (regexEmail.test(email.value)) {
                    window.alert("Valid Email");

                } else {
                    window.alert("Not valid email");
                    return false;
                }
                if (password.value === "")

                {
                    alert("Password must not be empty");
                    return false;
                } else if (password.value !== confirmpwd.value)
                {
                    window.alert("Passwords Don't Match");
                    return false;
                } else
                {
                    window.alert("Passwords Match");
                    return true;
                }
            }
        </script>
    </body>
    <?php
    include "./footer.php";
    ?>
</html>
