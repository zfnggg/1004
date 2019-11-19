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
//$profilepic = $_POST['profilePicture'];

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
    $errorMsg .= "username  is required.<br>";
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
    $errorMsg .= "role  is required.<br>";
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
    $cpassword = sanitize_input($_POST["confirmPassword"]);
    $success = true;
}

//PASSWORD
if ($password === $cpassword) {
    //echo "<h3>password matched</h3>";
} else {

    $errorMsg .= "<h3>Password does not match!</h3>";
    //echo "<h3>password does not match</h3>";
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
