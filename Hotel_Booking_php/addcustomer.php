<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
if (!isset($_SERVER['HTTP_REFERER'])) {
// redirect them to your desired location
    header('location:login.php');

    exit;
}
?>
<html lang="en">
    <head>
        <title>D'Hotel</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="shortcut icon" type="image/icon" href="./img/favicon.ico"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <!-- Main CSS Style Sheet-->
        <link href="css/main.css" rel = "stylesheet" /> 
        <!-- Zheng Feng CSS -->
        <!-- Events CSS Style Sheet-->
        <link href="css/events.css" rel = "stylesheet" /> 
        <!-- FAQ CSS Style Sheet-->
        <link href="css/faq.css" rel = "stylesheet" /> 
        <!-- Dining CSS Style Sheet-->
        <link href="css/dining.css" rel = "stylesheet" /> 
        <!-- Font Awesome Icons -->
        <script src='https://kit.fontawesome.com/a076d05399.js'></script> 
        <!-- Own Javascript -->
        <script defer src="js/main.js"></script> 
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

        <div class="jumbotron text-center">
            <h1>Add Customer</h1>
            <a href="customerprofile.php" title="manage">Customer</a> | 
            <a href="booking.php" title="manage">Booking</a> | 
            <a href="bookingsummary.php" title="manage">Booking Summary </a>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4">

                    <?php
                    define("DBHOST", "161.117.122.252");
                    define("DBNAME", "p1_4");
                    define("DBUSER", "p1_4");
                    define("DBPASS", "5xLMQfLGsc");
                    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
                    ?>

                    <form method="POST" name="addcustomer" action="process_addcustomer.php" enctype="multipart/form-data">
                        <table>
                            <tr>
                                <td>
                                    <label for="customerName">Name <input type="text" id="customerName" name="customerName" pattern="^(?=.{1,40}$)[a-zA-Z]+(?:[-'\s][a-zA-Z]+)*$" required></label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="username" >Username: <input type="text" id="username" name="username" pattern="^(?=.{1,40}$)[a-zA-Z]+(?:[-'\s][a-zA-Z]+)*$" required></label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="password" > Password  <input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required></label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="confirmPassword"> Confirm Password:<input type="password" id="confirmPassword" name="confirmPassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required></label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="email" > Email <input type="email" id="email" name="email" pattern="^\S+@\S+$" required> </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="phoneNo"> Phone No: <input type="text" id="phoneNo" name="phoneNo" pattern="[6,8,9][0-9]{7}" title="Please enter phone number as 8-digit numbers only" required> </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label> Role: </label>
                                        <input type="radio" name="role" value="C" required> Customer
                                        <input type="radio" name="role" value="A" required> Admin<br>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="profilePicture"> Profile Pic:<input type="file"  name="profilePicture" id="profilePicture"  accept=".png,.gif,.jpg,.webp" required> </label>
                                </td>
                            </tr>
                        </table>
                        <input type="submit" name="submit" value="Upload" class="btn btn-primary" onclick="myFunction()">
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
                            var role = document.forms["addcustomer"]["role"];
                            var profilepic = document.forms["addcustomer"]["profilePicture"];

                            if (customerName.value === "")
                            {
                                window.alert("Please enter customer name.");

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
                            if (role.value === "")
                            {
                                window.alert("Please select role.");

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
                </div>
            </div>
        </div>

        <!--Footer-->
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
