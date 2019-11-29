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
        ?>
    </header>

    <main>
        <?php

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            die('Invalid request method');
        } else {
            if (!isset($_POST['_token']) || ($_POST['_token'] !== $_SESSION['_token'])) {
                die($_POST['_token'] . "      " . $_SESSION['_token']);
            }
        }

        //Helper function that checks input for malicious or unwanted content.
        function sanitize_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $errorMsg = "";
        $email = sanitize_input($_POST["email"]);
        $name = sanitize_input($_POST["customerName"]);
        $cpword = sanitize_input($_POST["confirmPassword"]);
        $password = sanitize_input($_POST["password"]);
        $cname = sanitize_input($_POST['customerName']);
        $uname = sanitize_input($_POST['username']);
        $phoneno = sanitize_input($_POST['phoneNo']);
        $role = sanitize_input($_POST['role']);
        $success = true;

        //customer Name-----------------------------------------------------------------------------------------------------------------
        if (empty($_POST['customerName'])) {
            $errorMsg .= "Customer Name is required.<br>";
            $success = false;
        } else {
            if (preg_match("/^([a-zA-Z' ]+)$/", $name)) {
                if (strlen($name) >= 40) {
                    $errorMsg .= "Customer Name too long.<br>";
                    $success = false;
                }
            } else {
                $errorMsg .= "Invalid Customer Name.<br>";
                $success = false;
            }
        }


        //username Name-----------------------------------------------------------------------------------------------------------------
        if (empty($_POST['username'])) {
            $errorMsg .= "Username  is required.<br>";
            $success = false;
        } else {
            //$uname = sanitize_input($_POST["username"]);
            if (preg_match("/^([a-zA-Z' ]+)$/", $uname)) {
                if (strlen($uname) >= 40) {
                    $errorMsg .= "Userame too long.<br>";
                    $success = false;
                }
            } else {
                $errorMsg .= "Invalid Username.<br>";
                $success = false;
            }
        }

        //Password----------------------------------------------------------------------------------------------------------------
        if (empty($_POST['password'])) {
            $errorMsg .= "Password is required.<br>";
            $success = false;
        } else {
            //$password = sanitize_input($_POST["password"]);
            if (strlen($password) < 8 || strlen($password) > 30) {
                $errorMsg .= "Your Password Must Be Between 8 and 30 Characters!<br>";
                $success = false;
            } elseif (!preg_match("#[0-9]+#", $password)) {
                $errorMsg .= "Your Password Must Contain At Least 1 Number!<br>";
                $success = false;
            } elseif (!preg_match("#[A-Z]+#", $password)) {
                $errorMsg .= "Your Password Must Contain At Least 1 Capital Letter!<br>";
                $success = false;
            } elseif (!preg_match("#[a-z]+#", $password)) {
                $errorMsg .= "Your Password Must Contain At Least 1 Lowercase Letter!<br>";
                $success = false;
            } elseif (preg_match("#[\W]+#", $password)) {
                $errorMsg .= "Your Password Must not Contain any special characters!<br>";
                $success = false;
            }
        }


        //Confirm Password ---------------------------------------------------------------------------------------------------------
        if (empty($_POST['confirmPassword'])) {
            $errorMsg .= "Confirm password is required.<br>";
            $success = false;
        } else {
            //$cpword = sanitize_input($_POST["confirmPassword"]);
            if ($cpword != $password) {
                $errorMsg .= "Your passwords do not match!<br>";
                $success = false;
            }
            $success = true;
        }

        //EMAIL-----------------------------------------------------------------------------------------------------------------
        if (empty($_POST['email'])) {
            $errorMsg .= "Email is required.<br>";
            $success = false;
        } else {
            // Additional check to make sure e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errorMsg .= "Invalid email format.";
                $success = false;
            }
        }

        //phone no-----------------------------------------------------------------------------------------------------------------
        if (empty($_POST['phoneNo'])) {
            $errorMsg .= "Phone Number  is required.<br>";
            $success = false;
        } else {
            //$phoneno = sanitize_input($_POST["phoneNo"]);
            if (!preg_match("/^([6,8,9][0-9]{7}+)$/", $phoneno)) {
                $errorMsg .= "Invalid Phone Number.<br>";
                $success = false;
            }
        }


        require_once('../protected/config.php');
        $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

        if (isset($_POST["submit"]) == "Upload") {
            $cname = $_POST['customerName'];
            $uname = $_POST['username'];
            $pword = $_POST['password'];
            $cpword = $_POST['confirmPassword'];
            $email = $_POST['email'];
            $phoneno = $_POST['phoneNo'];
            //$profilepic = $_POST['profilePicture'];
            $role = $_POST['role'];

            $target_Folder = "images/";
            $target_Path = $target_Folder . basename($_FILES['profilePicture']['name']);
            $savepath = $target_Path . basename($_FILES['profilePicture']['name']);
            $file_name = $_FILES['profilePicture']['name'];
            $profilepic = "$target_Folder$file_name";


            if (isset($uname)) {
                $sql = $conn->prepare("SELECT * FROM users where username=? or email=? ");
                $sql->bind_param("ss", $uname, $email);
                $sql->execute();

                $result = $sql->get_result();
                //$result = mysqli_query($conn, $sql);
                $get_rows = mysqli_affected_rows($conn);

                if ($get_rows > 0) {
                    $errorMsg = "Username or Email already exists!";
                    $success = false;
                } else {
                    $EncryptPassword = md5($pword);
                    $sql_insert = $conn->prepare("insert into users (customerName,username,password,email,phoneNo,role,profilePicture)
                        values(?,?,?,?,?,?,?)");
                    move_uploaded_file($_FILES['profilePicture']['tmp_name'], $target_Path);
                    $sql_insert->bind_param("ssssiss", $cname, $uname, $EncryptPassword, $email, $phoneno, $role, $profilepic);
                    $result = $sql->get_result();
                    echo "$result";
                    $sql_insert->execute();
                    $sql_insert->close();
                    mysqli_close($conn);
                }
            }
        }

        //SUCCESS
        if ($success) {
            echo "<body>";
            echo "<section class=row>";
            echo "<div class='col-sm-2'></div>";
            echo "<div class='col-sm-8'>";
            echo "<h1>Your account has been successfully registered</h1>";
            echo "</div>";
            echo "<div class='col-sm-2'></div>";
            echo "<br>";
            echo "</section>";

            echo "<section class=row>";
            echo "<div class='col-sm-5'></div>";
            echo "<div class='col-sm-2'>";
            echo ("<button onclick=\"location.href='login.php'\">Click here to Login</button>");
            echo "</div>";
            echo "<div class='col-sm-5'></div>";
            echo "</div>";
            echo "</section>";
            echo "</body>";
            echo "<hr>";
        } else {
            echo "<body>";
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
            echo ("<button onclick=\"location.href='registration.php'\">Return to Registration</button>");
            echo "</div>";
            echo "<div class='col-sm-5'></div>";
            echo "</div>";
            echo "</section>";
            echo "</body>";
            echo "<hr>";
        }
        ?>
    </main>

    <?php
    include "./footer.php";
    ?>
</body>


</html>