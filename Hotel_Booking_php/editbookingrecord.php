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
    <!-- Main CSS Style Sheet-->
    <link href="css/main.css" rel="stylesheet" />
    <!-- Zheng Feng CSS -->
    <!-- Events CSS Style Sheet-->
    <link href="css/events.css" rel="stylesheet" />
    <!-- FAQ CSS Style Sheet-->
    <link href="css/faq.css" rel="stylesheet" />
    <!-- Dining CSS Style Sheet-->
    <link href="css/dining.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <!-- Own Javascript -->
    <script defer src="js/main.js"></script>
</head>

<body>

    <header>
        <?php
        include "./navbaruser.php";
        if (!isset($_SERVER['HTTP_REFERER'])) {
            // redirect them to your desired location
            header('location:login.php');

            exit;
        }
        ?>
    </header>

    <main>

        <?php

        require_once('../protected/config.php');

        $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

        if (isset($_POST["submit"])) {
            $cidToUpdate = $_POST["cid"];
            $newName = $_POST["name"];


            $sql = $conn->prepare("update booking set status = ? where bookingID = ?");
            $sql->bind_param("si", $newName, $cidToUpdate);
            $sql->execute();
            $sql->close();
            //header("Location:booking.php?id=$cidToUpdate");
            mysqli_close($conn);
        }
        ?>

        <?php

        $errorMsg = "";
        $newName = sanitize_input($_POST["name"]);
        $success = true;

        //
        if (empty($_POST['name'])) {
            $errorMsg .= "Status is required.<br>";
            $success = false;
        } else {

            $success = true;
        }

        //SUCCESS
        if ($success) {
            echo "<h1>Updated Successfully</h1>";
            echo "<h2>Status : $newName </h2>";
            echo ("<button onclick=\"location.href='booking.php?id=$cidToUpdate'\">Return to Booking record.</button>");
        } else {
            echo "<h1>Oops!</h1>";
            echo "<h4>The following input errors were detected:</h4>";
            echo "<p>" . $errorMsg . "</p>";
            echo "<br>";
            echo ("<button onclick=\"location.href='booking.php?id=$cidToUpdate'\">Return to booking.</button>");
        }

        //Helper function that checks input for malicious or unwanted content.
        function sanitize_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>
    </main>

    <?php
    include "./footer.php";
    ?>
</body>

</html>