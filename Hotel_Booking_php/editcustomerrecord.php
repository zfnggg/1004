<?php

if (!isset($_SERVER['HTTP_REFERER'])) {
// redirect them to your desired location
    header('location:login.php');

    exit;
}
?>
<?php

session_start();

define("DBHOST", "161.117.122.252");
define("DBNAME", "p1_4");
define("DBUSER", "p1_4");
define("DBPASS", "5xLMQfLGsc");

$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
if (isset($_POST["submit"]) == "Upload") {
    $cidToUpdate = $_POST["cid"];
    $newName = $_POST["cName"];
    $pword = $_POST['pword'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];
//$pic = $_POST['profilePicture'];
    $pword = mysqli_real_escape_string($conn, $pword);
    $pword = md5($pword);


    $target_Folder = "images/";
    $target_Path = $target_Folder . basename($_FILES['profilePicture']['name']);
    $savepath = $target_Path . basename($_FILES['profilePicture']['name']);
    $file_name = $_FILES['profilePicture']['name'];
    $profilepic = "$target_Folder$file_name";

    $sql = $conn->prepare("update users set customerName =?, password =?, email =?, phoneNo=?, role = ?, profilePicture=? where userID=?");
    move_uploaded_file($_FILES['profilePicture']['tmp_name'], $target_Path);
    $sql->bind_param("sssissi", $newName, $pword, $email, $phone, $role, $profilepic, $cidToUpdate);
    $sql->execute();
    $result = $sql->get_result();
    $sql->close();
    //$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));


    mysqli_close($conn);

    //header("Location:customerprofile.php?id=$cidToUpdate");
}
?>

<?php

$email = $errorMsg = "";
$pword = sanitize_input($_POST["pword"]);
$newName = sanitize_input($_POST['cName']);
$phone = sanitize_input($_POST['phone']);
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
if (empty($_POST['cName'])) {
    $errorMsg .= "Customer Name is required.<br>";
    $success = false;
} else {
    $newName = sanitize_input($_POST["cName"]);
    $success = true;
}

//phone no
if (empty($_POST['phone'])) {
    $errorMsg .= "phoneNo  is required.<br>";
    $success = false;
} else {
    $phoneno = sanitize_input($_POST["phone"]);
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
if (empty($_POST['pword'])) {
    $errorMsg .= "Password is required.<br>";
    $success = false;
} else {
    $password = sanitize_input($_POST["pword"]);
    $success = true;
}



//SUCCESS
if ($success) {
    echo "<h1>Added Successfully</h1>";
    echo "<h2>Customer Records</h2>";
    echo "<h2>Customer Name : $newName </h2>";

    echo "<h2 >email  :   $email</h2>";
    echo "<h2 >phone no : $phoneno</h2>";
    echo "<h2 >role : $role</h2>";
    echo("<button onclick=\"location.href='customerprofile.php?id=$cidToUpdate'\">Return to Customer record.</button>");
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


