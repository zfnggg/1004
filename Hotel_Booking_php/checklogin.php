<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en-US">

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

<header>
    <?php
    include "./navbaruser.php";
    ?>
</header>

<body>
    <?php
    //Just for MAC, for windows need to change accordingly 
    //require_once('/Applications/XAMPP/xamppfiles/protected/config.php');
    //For windows
    require_once('../protected/config.php');

    //CSRF Token Authentication
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        die('Invalid request method');
    } else {
        if (!isset($_POST['_token']) || ($_POST['_token'] !== $_SESSION['_token'])) {
            die($_POST['_token'] . "      " . $_SESSION['_token']);
        }
    }

    $email = $errorMsg = "";
    $success = true;
    $c = $_POST['captcha'];

    //Sanitize User Inputs
    function sanitize_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //Username Check
    if (empty($_POST["username"])) {
        $errorMsg .= "Username is required.<br>";
        $success = false;
    } else {
        $username = sanitize_input($_POST["username"]);
        if (preg_match("/^([a-zA-Z' ]+)$/", $username)) {
            if (strlen($username) >= 40) {
                $errorMsg .= "Userame too long.<br>";
                $success = false;
            }
        } else {
            $errorMsg .= "Invalid Username.<br>";
            $success = false;
        }
    }


    //Password Check
    if (empty($_POST["password"])) {
        $errorMsg .= "Password is required.<br>";
        $success = false;
    } else {
        $p = sanitize_input($_POST["password"]);
        $p = md5($p);
    }

    //Captcha Check
    if ($c != $_SESSION['captcha_code']) {
        $errorMsg .= "CAPTCHA Code enterred is invalid.";
        $success = false;
    }


    if (!isset($_POST["submit"])) {
        $errorMsg .= "Incomplete form";
        $success = false;
    }

    //If any of the checks fail, triggered
    if ($success == false) {
        echo "<section class=row>";
        echo "<div class='col-sm-3'></div>";
        echo "<div class='col-sm-6'>";
        echo "<h3>The following errors were detected:<h3>";
        echo "<h4> $errorMsg </h4>";
        echo "</div>";
        echo "<div class='col-sm-3'></div>";
        echo "<br>";
        echo "</section>";

        echo "<div class=row>";
        echo "<div class='col-sm-5'></div>";
        echo "<div class='col-sm-2'>";
        echo ("<button onclick=\"location.href='./login.php'\">Return to Login</button>");
        echo "</div>";
        echo "<div class='col-sm-5'></div>";
        echo "</div>";
        echo "</div>";
        echo "<hr>";
    } 
    
    else {
        $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
        $u = $_POST['username'];
        $p = $_POST['password'];
        $u = mysqli_real_escape_string($conn, $u);
        $p = mysqli_real_escape_string($conn, $p);
        $p = md5($p);

        $sql = $conn->prepare("SELECT * FROM users WHERE username = ? and password= ? ");
        $sql->bind_param("ss", $u, $p);
        $sql->execute();
        $search_result = $sql->get_result();

        //$search_result = mysqli_query($conn, $sql);
        $userfound = mysqli_fetch_assoc($search_result);

        if ($userfound >= 1) {
            $sql = $conn->prepare("SELECT * FROM users WHERE username = ? ");
            $sql->bind_param("s", $u);
            $sql->execute();
            $search_result = $sql->get_result();
            //$search_result = mysqli_query($conn, $sql);
            $one_record = mysqli_fetch_assoc($search_result);
            $r = $one_record['role'];
            $_SESSION['MM_Username'] = $u;
            $_SESSION['MM_role'] = $r;
            header("Location:reservation.php");
        } else {
            echo "<section class=row>";
            echo "<div class='col-sm-3'></div>";
            echo "<div class='col-sm-6'>";
            echo "<h1>Username not found or password doesn't match...<h1>";
            echo "</div>";
            echo "<div class='col-sm-3'></div>";
            echo "<br>";
            echo "</section>";

            echo "<section class=row>";
            echo "<div class='col-sm-5'></div>";
            echo "<div class='col-sm-2'>";
            echo ("<button onclick=\"location.href='./login.php'\">Return to Login</button>");
            echo "</div>";
            echo "<div class='col-sm-5'></div>";
            echo "</div>";
            echo "</section>";
            echo "<hr>";
        }
        $sql->close();
        mysqli_close($conn);
    }

    ?>

    <?php
    include "./footer.php";
    ?>

</body>

</html>