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
    <link rel="shortcut icon" type="image/icon" href="./img/favicon.ico" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>-->
    <link href="css/main.css" rel="stylesheet" />
    <!-- Own CSS Style Sheet-->
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <!-- Font Awesome Icons -->
    <script defer src="js/main.js"></script>
    <!-- Own Javascript -->
</head>


<body>

    <header>
        <?php
        include "./navbaruser.php";
        require_once('../protected/config.php');
        $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
        if (!isset($_SERVER['HTTP_REFERER'])) {
            // redirect them to your desired location
            header('location:login.php');

            exit;
        }
        ?>
    </header>

    <main>
        <?php

        //Helper function that checks input for malicious or unwanted content.
        function sanitize_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $errorMsg = "";
        $checkin = sanitize_input($_POST["check_in"]);
        $checkout = sanitize_input($_POST['check_out']);
        $total = sanitize_input($_POST['total_sum']);
        $num_days = sanitize_input($_POST['num_days']);
        $pax = sanitize_input($_POST["pax"]);
        $success = true;

        //check_in
        if (empty($_POST['check_in'])) {
            $errorMsg .= "check in  is required.<br>";
            $success = false;
        }

        //check_out
        if (empty($_POST['check_out'])) {
            $errorMsg .= "check_out  is required.<br>";
            $success = false;
        }

        //check for empty total_sum
        if (empty($_POST['total_sum'])) {
            $errorMsg .= "total sum is required.<br>";
            $success = false;
        }

        //check for empty pax
        if (empty($_POST['pax'])) {
            $errorMsg .= "Pax is required.<br>";
            $success = false;
        }

        //check for empty num_days
        if (empty($_POST['num_days'])) {
            $errorMsg .= "num days is required.<br>";
            $success = false;
        }


        if (!isset($_['submit'])) {
            $userID = $_POST['userID'];
            $roomID = $_POST['roomID'];
            $checkin = $_POST['check_in'];
            $checkout = $_POST['check_out'];
            $total = $_POST['total_sum'];
            $num_days = $_POST['num_days'];
            $status = $_POST['status'];
            $pax = $_POST['pax'];



            $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

            $sql = $conn->prepare("insert into booking (userID,roomID,checkin,checkout,total,numdays,status,pax) values (?,?,?,?,?,?,?,?)");
            $sql->bind_param("iissiisi", $userID, $roomID, $checkin, $checkout, $total, $num_days, $status, $pax);
            $sql->execute();
            $result = $sql->get_result();
            $sql->close();
            mysqli_close($conn);
            //header("Location:bookroom.php?id=$roomID");
        }
        ?>

        <?php


        //SUCCESS
        if ($success) {
            echo "<section class=row>";
            echo "<div class='col-sm-2'></div>";
            echo "<div class='col-sm-8'>";
            echo "<h1>Booking Successful</h1>";
            echo "<h2>Customer ID : $userID </h2>";
            echo "<h2>Room ID : $roomID </h2>";
            echo "<h2 >Checkin  :   $checkin</h2>";
            echo "<h2 >Checkout : $checkout</h2>";
            echo "<h2 >Total : $total</h2>";
            echo "<h2 >Num of days : $num_days</h2>";
            echo "<h2 >Num of pax : $pax</h2>";
            echo "</div>";
            echo "<div class='col-sm-2'></div>";
            echo "<br>";
            echo "</section>";

            echo "<section class=row>";
            echo "<div class='col-sm-5'></div>";
            echo "<div class='col-sm-2'>";
            echo ("<button onclick=\"location.href='bookroom.php?id=$roomID'\">Return to Booking.</button>");
            echo "</div>";
            echo "<div class='col-sm-5'></div>";
            echo "</div>";
            echo "</section>";
            echo "<hr>";
        } else {
            echo "<section class=row>";
            echo "<div class='col-sm-3'></div>";
            echo "<div class='col-sm-6'>";
            echo "<h1>" . $errorMsg . "</h1>";
            echo "</div>";
            echo "<div class='col-sm-3'></div>";
            echo "<br>";
            echo "</section>";

            echo "<section class=row>";
            echo "<div class='col-sm-5'></div>";
            echo "<div class='col-sm-2'>";
            echo ("<button onclick=\"location.href='bookroom.php?id=$roomID'\">Return to Booking.</button>");
            echo "</div>";
            echo "<div class='col-sm-5'></div>";
            echo "</div>";
            echo "</section>";
            echo "<hr>";
        }

        ?>

    </main>

    <?php
    include "./footer.php";
    ?>
</body>

</html>