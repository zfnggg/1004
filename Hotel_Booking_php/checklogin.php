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

    <header>
        <?php
        include "./navbaruser.php";
        ?>

        <meta charset="utf-8">
        <title>Check Login</title>
    </header>

    <body>
            <?php
            //session_start();
            //Just for MAC, for windows need to change accordingly 
            //require_once('/Applications/XAMPP/xamppfiles/protected/config.php');
            //For windows
            require_once('../protected/config.php');

            $email = $errorMsg = "";
            $success = true;
            $c = $_POST['captcha'];

            function sanitize_input($data)
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            //will not need php validation
            //username-----------------------------------------------------------------------------------------------------------------
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


            //password-----------------------------------------------------------------------------------------------------------------
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

            if (!isset($_POST["submit"]))
            {
                $errorMsg .= "Incomplete form";
                $success = false;
            }

            if ($success == false) 
            {
                echo "<div class=row>";
                echo "<div class='col-sm-3'></div>";
                echo "<div class='col-sm-6'>";
                echo "<h1>The following errors were detected.<h1>";
                echo "<h2> . $errorMsg . </h2>";
                echo "</div>";
                echo "<div class='col-sm-3'></div>";
                echo "<br>";
                echo "</div>";

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
            
            else 
            {
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

                    if ($userfound >= 1) 
                    {
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
                    } 
                    
                    else 
                    {
                        echo "<div class=row>";
                        echo "<div class='col-sm-3'></div>";
                        echo "<div class='col-sm-6'>";
                        echo "<h1>Username not found or password doesn't match...<h1>";
                        echo "</div>";
                        echo "<div class='col-sm-3'></div>";
                        echo "<br>";
                        echo "</div>";

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
                    $sql->close();
                    mysqli_close($conn);
        }

        ?>

        <?php
        include "./footer.php";
        ?>

    </body>

</html>