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
        ?>
    </header>

<?php
//
//session_start();
require_once('../protected/config.php');
$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

if (isset($_POST["submit"]) == "Upload") {
    $userID = $_POST["userID"];
    $cname = $_POST['customerName'];
//$uname = $_POST['MM_Username'];
    $uname = $_POST['username'];
    $pword = $_POST['password'];
    $email = $_POST['email'];
    $phoneno = $_POST['phoneNo'];
//$profilepic = $_POST['profilePicture'];
//$u = mysqli_real_escape_string($conn, $u);
//$pword = mysqli_real_escape_string($conn, $pword);
    $pword = md5($pword);
    
    $target_Folder = "images/";
    $target_Path = $target_Folder . basename($_FILES['profilePicture']['name']);
    $savepath = $target_Path . basename($_FILES['profilePicture']['name']);
    $file_name = $_FILES['profilePicture']['name'];
    $profilepic = "$target_Folder$file_name";

    //$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    $sql = $conn->prepare("update users set customerName=?,username=?, password=?,email=?,phoneNo=?,profilePicture=? where userID=?");
    move_uploaded_file($_FILES['profilePicture']['tmp_name'], $target_Path);    
    $sql->bind_param("ssssisi", $cname, $uname, $pword,$email, $phoneno, $profilepic, $userID);
    $sql->execute();
    $result = $sql->get_result();
    $sql->close();
    //header("Location:editmyprofile.php?id=$custid");
    mysqli_close($conn);
}
?>


<?php

$errorMsg = "";
$email = sanitize_input($_POST["email"]);
//$password = sanitize_input($_POST["password"]);
$password = sanitize_input($_POST["password"]);
//$cname = sanitize_input($_POST['customerName']);
$name = sanitize_input($_POST["customerName"]);
$uname = sanitize_input($_POST["username"]);
//$phoneno = sanitize_input($_POST['phoneNo']);
$phoneno = sanitize_input($_POST["phoneNo"]);
$success = true;

//customer Name
if (empty($_POST['customerName'])) {
    $errorMsg .= "Customer Name is required.<br>";
    $success = false;
} else {
    if (preg_match("/^([a-zA-Z' ]+)$/", $name)) {
        if (strlen($name) >= 40) {
            $errorMsg .= "Customer Name too long.<br>";
            $success = false;
        }
    }
    else {
        $errorMsg .= "Invalid Customer Name.<br>";
        $success = false;
    }
}

//username
if (empty($_POST['username'])) {
    $errorMsg .= "username  is required.<br>";
    $success = false;
} else {
    if (preg_match("/^([a-zA-Z' ]+)$/", $uname)) {
        if (strlen($uname) >= 40) {
            $errorMsg .= "Userame too long.<br>";
            $success = false;
        }
    }
    else {
        $errorMsg .= "Invalid Username.<br>";
        $success = false;
    }
}

//PASSWORD
//Cannot be checked becos the variable is md5 hashed
if (empty($_POST['password'])) {
    $errorMsg .= "Password is required.<br>";
    $success = false;
} else {
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
    }
    elseif (preg_match("#[\W]+#", $password)) {
        $errorMsg .= "Your Password Must not Contain any special characters!<br>";
        $success = false;
    }
}

//EMAIL
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

//phone no
if (empty($_POST['phoneNo'])) {
    $errorMsg .= "phoneNo  is required.<br>";
    $success = false;
} else {
    if (!preg_match("/^([6,8,9][0-9]{7}+)$/", $phoneno)) {
        $errorMsg .= "Invalid Phone Number.<br>";
        $success = false;
    }
}


//SUCCESS
if ($success) {
    echo "<h1>Updated Successfully</h1>";
    echo "<h2>Customer Records</h2>";
    echo "<h2>Customer Name : $cname </h2>";
    echo "<h2 >Username :  $uname</h2>";
    echo "<h2 >email  :   $email</h2>";
    echo "<h2 >phone no : $phoneno</h2>";

    echo("<button onclick=\"location.href='editmyprofile.php?id=$userID'\">Return to Customer record.</button>");
} else {
    echo "<h1>Oops!</h1>";
    echo "<h4>The following input errors were detected:</h4>";
    echo "<p>" . $errorMsg . "</p>";
    echo "<br>";
    echo("<button onclick=\"location.href='editmyprofile.php?id=$userID'\">Return to Customer record.</button>");
}

//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

    </body>

<?php
    include "./footer.php";
    ?>

</html>

