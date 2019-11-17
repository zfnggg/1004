<?php
include "./navbaruser.php";
?>

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

    <main>
        <?php

            //Helper function that checks input for malicious or unwanted content.
            function sanitize_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            $email = $errorMsg = "";
            $cpword = sanitize_input($_POST["confirmPassword"]);
            $password = sanitize_input($_POST["password"]);
            $cname = sanitize_input($_POST['customerName']);
            $uname = sanitize_input($_POST['username']);
            $phoneno = sanitize_input($_POST['phoneNo']);
            $role = sanitize_input($_POST['role']);
            $success = true;


            //EMAIL
            if (empty($_POST['email'])) {
                $errorMsg .= "Email is required.<br>";
                $success = false;
            } else {
                $email = sanitize_input($_POST["email"]);
                // Additional check to make sure e-mail address is well-formed
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errorMsg .= "Invalid email format.";
                    $success = false;
                }
            }

            //customer Name
            if (empty($_POST['customerName'])) {
                $errorMsg .= "Customer Name is required.<br>";
                $success = false;
            } else {
                $name = sanitize_input($_POST["customerName"]);
                $success = true;
            }

            //username Name
            if (empty($_POST['username'])) {
                $errorMsg .= "Username  is required.<br>";
                $success = false;
            } else {
                $uname = sanitize_input($_POST["username"]);
                $success = true;
            }

            //phone no
            if (empty($_POST['phoneNo'])) {
                $errorMsg .= "phoneNo  is required.<br>";
                $success = false;
            } else {
                $phoneno = sanitize_input($_POST["phoneNo"]);
                $success = true;
            }

            //role 
            if (empty($_POST['role'])) {
                $errorMsg .= "Role  is required.<br>";
                $success = false;
            } else {
                $role = sanitize_input($_POST["role"]);
                $success = true;
            }

            //check for empty password 
            if (empty($_POST['password'])) {
                $errorMsg .= "Password is required.<br>";
                $success = false;
            } else {
                $password = sanitize_input($_POST["password"]);
                $success = true;
            }

            //check for empty confirm password 
            if (empty($_POST['confirmPassword'])) {
                $errorMsg .= "Confirm password is required.<br>";
                $success = false;
            } else {
                $cpword = sanitize_input($_POST["confirmPassword"]);
                $success = true;
            }

            //PASSWORD
            if ($password === $cpword) {
                //echo "<h3>password matched</h3>";
            } else {
                $errorMsg .= "<h3>Password does not match!</h3>";
                //echo "<h3>password does not match</h3>";
                $success = false;
            }


            if ($success) {
                $cname = $_POST['customerName'];
                $uname = $_POST['username'];
                $pword = $_POST['password'];
                $cpword = $_POST['confirmPassword'];
                $email = $_POST['email'];
                $phoneno = $_POST['phoneNo'];
                $profilepic = $_POST['profilePicture'];
                $role = $_POST['role'];

                 //require_once('/Applications/XAMPP/xamppfiles/protected/config.php');
                 require_once('../protected/config.php');

                $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

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
                echo "<div class=row>";
                echo "<div class='col-sm-2'></div>";
                echo "<div class='col-sm-8'>";
                echo "<h1>Your account has been successfully registered</h1>";
                echo "</div>";
                echo "<div class='col-sm-2'></div>";
                echo "<br>";
                echo "</div>";

                echo "<div class=row>";
                echo "<div class='col-sm-5'></div>";
                echo "<div class='col-sm-2'>";
                echo ("<button onclick=\"location.href='login.php'\">Click here to Login</button>");
                echo "</div>";
                echo "<div class='col-sm-5'></div>";
                echo "</div>";
                echo "</div>";
                echo "<hr>";

            } 
            
            else {
                echo "<div class=row>";
                echo "<div class='col-sm-3'></div>";
                echo "<div class='col-sm-6'>";
                echo "<h1>" . $errorMsg . "</h1>";
                echo "</div>";
                echo "<div class='col-sm-3'></div>";
                echo "<br>";
                echo "</div>";

                echo "<div class=row>";
                echo "<div class='col-sm-5'></div>";
                echo "<div class='col-sm-2'>";
                echo ("<button onclick=\"location.href='registration.php'\">Return to Registration</button>");
                echo "</div>";
                echo "<div class='col-sm-5'></div>";
                echo "</div>";
                echo "</div>";
                echo "<hr>";
            }
            ?>
    </main>
</body>
<?php
        include "./footer.php";
        ?>

</html>
