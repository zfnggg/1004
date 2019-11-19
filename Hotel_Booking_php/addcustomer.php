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

    <header>
        <?php
        include "./navbaruser.php";
        ?>
    </header>

    <main>
        <section class="jumbotron text-center">
            <h1>Add Customer</h1>
            <a href="customerprofile.php" title="manage">Customer</a> |
            <a href="booking.php" title="manage">Booking</a> |
            <a href="bookingsummary.php" title="manage">Booking Summary </a>
        </section>

        <section class="container-fluid">
            <div class="row">
                <div class="col-sm-4">

                    <?php
                    require_once('../protected/config.php');
                    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
                    ?>
                    <!--onsubmit="return validateAddCustomer()"-->
                    <form method="POST" name="addcustomer" action="process_addcustomer.php" enctype="multipart/form-data" novalidate >
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td>
                                        <label for="customerName">Name <input type="text" id="customerName" name="customerName" pattern="^(?=.{1,40}$)[a-zA-Z]+(?:[-'\s][a-zA-Z]+)*$" required></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="username">Username: <input type="text" id="username" name="username" pattern="^(?=.{1,40}$)[a-zA-Z]+(?:[-'\s][a-zA-Z]+)*$" required></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="password"> Password <input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,30}" required></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="confirmPassword"> Confirm Password:<input type="password" id="confirmPassword" name="confirmPassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,30}" required></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="email"> Email <input type="email" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required> </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="phoneNo"> Phone No: <input type="text" id="phoneNo" name="phoneNo" pattern="[6,8,9][0-9]{7}" title="Please enter phone number as 8-digit numbers only" required> </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>

                                        <label for="role"> Role:
                                            <input type="radio" name="role" id="role" value="C" required> Customer<br>
                                            <input type="radio" name="role" id="role" value="A" required> Admin<br>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="profilePicture"> Profile Pic:<input type="file" name="profilePicture" id="profilePicture" accept=".png,.gif,.jpg,.webp" required> </label>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <input type="submit" name="submit" value="Upload" class="btn btn-primary" onclick="myFunction()">
                    </form>
                </div>
            </div>
        </section>
    </main>

    <?php
    include "./footer.php";
    ?>

</body>

</html>