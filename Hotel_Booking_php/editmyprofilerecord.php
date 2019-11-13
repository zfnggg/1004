<?php

session_start();
define("DBHOST", "161.117.122.252");
define("DBNAME", "p1_4");
define("DBUSER", "p1_4");
define("DBPASS", "5xLMQfLGsc");

$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

if (isset($_POST["submit"]) == "Upload") {
    $custid = $_POST["customerID"];
    $cname = $_POST['customerName'];
//$uname = $_POST['MM_Username'];
    $uname = $_POST['username'];
    $pword = $_POST['password'];
    $email = $_POST['email'];
    $phoneno = $_POST['phoneNo'];
//$profilepic = $_POST['profilePicture'];
//$u = mysqli_real_escape_string($conn, $u);
    $pword = mysqli_real_escape_string($conn, $pword);
    $pword = md5($pword);

    $target_Folder = "images/";
    $target_Path = $target_Folder . basename($_FILES['profilePicture']['name']);
    $savepath = $target_Path . basename($_FILES['profilePicture']['name']);
    $file_name = $_FILES['profilePicture']['name'];
    $profilepic = "$target_Folder$file_name";

    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    $sql = $conn->prepare("update customer set customerName=?,username=?,password=?,email=?,phoneNo=?,profilePicture=? where customerID=?");
    $sql->bind_param("ssssisi", $cname, $uname, $pword, $email, $phoneno, $profilepic, $custid);
    $sql->execute();
    $result = $sql->get_result();
    $sql->close();

    //header("Location:editmyprofile.php?id=$custid");


    mysqli_close($conn);
}
?>


<?php

$email = $errorMsg = "";

$password = sanitize_input($_POST["password"]);
$cname = sanitize_input($_POST['customerName']);
$uname = sanitize_input($_POST['username']);
$phoneno = sanitize_input($_POST['phoneNo']);


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

//username
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


//check for empty password
if (empty($_POST['password'])) {
    $errorMsg .= "Password is required.<br>";
    $success = false;
} else {
    $password = sanitize_input($_POST["password"]);
    $success = true;
}


//SUCCESS
if ($success) {
    echo "<h1>Updated Successfully</h1>";
    echo "<h2>Customer Records</h2>";
    echo "<h2>Customer Name : $cname </h2>";
    echo "<h2 >Username :  $uname</h2>";
    echo "<h2 >email  :   $email</h2>";
    echo "<h2 >phone no : $phoneno</h2>";

    echo("<button onclick=\"location.href='editmyprofile.php?id=$custid'\">Return to Customer record.</button>");
} else {
    echo "<h1>Oops!</h1>";
    echo "<h4>The following input errors were detected:</h4>";
    echo "<p>" . $errorMsg . "</p>";
    echo "<br>";
    echo("<button onclick=\"location.href='editmyprofile.php?id=$custid'\">Return to Customer record.</button>");
}

//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

