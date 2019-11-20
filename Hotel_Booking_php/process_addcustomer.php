<?php
require_once('../protected/config.php');
$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
?>
<?php

if (!isset($_GET['action'])) {
    $cname = $_POST['customerName'];
    $uname = $_POST['username'];
    $pword = $_POST['password'];
    $email = $_POST['email'];
    $phoneno = $_POST['phoneNo'];
    $role = $_POST['role'];
//                        $profilepic = $_POST['profilePicture'];

    if (isset($_POST["submit"]) == "Upload") {

        $target_Folder = "images/";
        $target_Path = $target_Folder . basename($_FILES['profilePicture']['name']);
        $savepath = $target_Path . basename($_FILES['profilePicture']['name']);
        $file_name = $_FILES['profilePicture']['name'];
        $pic = "$target_Folder$file_name";

        $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

        if (isset($uname)) {
            $sql = $conn->prepare("SELECT * FROM users where username=?");
            $sql->bind_param("s", $u);
            $sql->execute();
            $result = $sql->get_result();
            //$result = mysqli_query($conn, $sql);
            $get_rows = mysqli_affected_rows($conn);

            if ($get_rows > 0) {
                echo "USERNAME EXISTS!!";
                die();
            } else {
                $EncryptPassword = md5($pword);
                $sql_insert = $conn->prepare("insert into users (customerName,username,password,email,phoneNo,role,profilePicture)
                            values(?,?,?,?,?,?,?)");
                //values('$cname', '$uname', '$pword', '$email', '$phoneno', '$role', '" . $target_Folder . $file_name . "')");
                move_uploaded_file($_FILES['profilePicture']['tmp_name'], $target_Path);
                $sql_insert->bind_param("ssssiss", $cname, $uname, $EncryptPassword, $email, $phoneno, $role, $pic);
                $sql_insert->execute();
                $result = $sql->get_result();
                $sql_insert->close();
                mysqli_close($conn);
            }
        }
    }
}
?>

<?php

$email = $errorMsg = "";
$cpassword = sanitize_input($_POST["confirmPassword"]);
$password = sanitize_input($_POST["password"]);
$cname = sanitize_input($_POST['customerName']);
$uname = sanitize_input($_POST['username']);
$phoneno = sanitize_input($_POST['phoneNo']);
//$role = sanitize_input($_POST['role']);

$success = true;


//customer Name
if (empty($_POST['customerName'])) {
    $errorMsg .= "Customer Name is required.<br>";
    $success = false;
} else {
    if (preg_match("/^([a-zA-Z' ]+)$/", $cname)) {
        if (strlen($cname) >= 40) {
            $errorMsg .= "Customer Name too long.<br>";
            $success = false;
        }
    }
    else {
        $errorMsg .= "Invalid Customer Name.<br>";
        $success = false;
    }
}

//username Name
if (empty($_POST['username'])) {
    $errorMsg .= "Username  is required.<br>";
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

//check for empty confirm password
if (empty($_POST['confirmPassword'])) {
    $errorMsg .= "Confirm password is required.<br>";
    $success = false;
} else {
    if ($cpassword != $password) {
        $errorMsg .= "Your passwords do not match!<br>";
        $success = false;
    }
    $success = true;
}

//EMAIL
if (empty($_POST['email'])) {
    $errorMsg .= "Email is required.<br>";
    $success = false;
} else {
    $email = sanitize_input($_POST["email"]);
    // Additional check to make sure e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg .= "Invalid email format.<br>";
        $success = false;
    }
}

//phone no
if (empty($_POST['phoneNo'])) {
    $errorMsg .= "Phone Number  is required.<br>";
    $success = false;
} else {
    if (!preg_match("/^([6,8,9][0-9]{7}+)$/", $phoneno)) {
        $errorMsg .= "Invalid Phone Number.<br>";
        $success = false;
    }
}

//role
if (!isset($_POST['role'])) {
    $errorMsg .= "role  is required.<br>";
    $success = false;
} else {
    $role = sanitize_input($_POST["role"]);
    $success = true;
}

//profile picture
if (empty($_POST['profilePicture'])) {
    $errorMsg .= "Profile Picture is required.<br>";
    $success = false;
}


//SUCCESS
if ($success) {
    echo "<h1>Added Successfully</h1>";
    echo "<h2>Customer Records</h2>";
    echo "<h2>Customer Name : $cname </h2>";
    echo "<h2 >Username :  $uname</h2>";
    echo "<h2 >email  :   $email</h2>";
    echo "<h2 >phone no : $phoneno</h2>";
    echo "<h2 >role : $role</h2>";
    echo("<button onclick=\"location.href='addcustomer.php'\">Back</button>");
} else {
    echo "<h1>Oops!</h1>";
    echo "<h4>The following input errors were detected:</h4>";
    echo "<p>" . $errorMsg . "</p>";
    echo "<br>";
    echo("<button onclick=\"location.href='addcustomer.php'\">Return add customer.</button>");
}

//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
