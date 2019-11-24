<?php

if (!isset($_SERVER['HTTP_REFERER'])) {
// redirect them to your desired location
    header('location:login.php');

    exit;
}

?>
<?php

session_start();

require_once('../protected/config.php');

$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
if (isset($_POST["submit"]) == "Upload") {
    $cidToUpdate = $_POST["cid"];
    $newName = $_POST["cName"];
    $pword = $_POST['pword'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];
    $EncryptPassword = md5($pword);
    //$pic = $_POST['profilePicture'];
    //$pword = mysqli_real_escape_string($conn, $pword);
   


    $target_Folder = "images/";
    $target_Path = $target_Folder . basename($_FILES['profilePicture']['name']);
    $savepath = $target_Path . basename($_FILES['profilePicture']['name']);
    $file_name = $_FILES['profilePicture']['name'];
    $profilepic = "$target_Folder$file_name";
    
    $sql = $conn->prepare("update users set customerName =?, password =?, email =?, phoneNo=?, role = ?, profilePicture=? where userID=?");
    move_uploaded_file($_FILES['profilePicture']['tmp_name'], $target_Path);
    $sql->bind_param("sssissi", $newName, $EncryptPassword, $email, $phone, $role, $profilepic, $cidToUpdate);
    $sql->execute();
    $result = $sql->get_result();
    
    $sql->close();
    //$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    mysqli_close($conn);
    //header("Location:customerprofile.php?id=$cidToUpdate");
}
?>

<?php

$errorMsg = "";
$name = sanitize_input($_POST["cName"]);
$email = sanitize_input($_POST["email"]);
//Got 2 occurrences of this. Which one is which?
$pword = sanitize_input($_POST["pword"]);
$password = sanitize_input($_POST["pword"]);
$newName = sanitize_input($_POST['cName']);
//$phone = sanitize_input($_POST['phone']);
$phoneno = sanitize_input($_POST["phone"]);
//$role = sanitize_input($_POST['role']);

$success = true;


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

//customer Name
if (empty($_POST['cName'])) {
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

//phone no
if (empty($_POST['phone'])) {
    $errorMsg .= "phoneNo  is required.<br>";
    $success = false;
} else {
    if (!preg_match("/^([6,8,9][0-9]{7}+)$/", $phoneno)) {
        $errorMsg .= "Invalid Phone Number.<br>";
        $success = false;
    }
}

//role
if (empty($_POST['role'])) {
    $errorMsg .= "role  is required.<br>";
    $success = false;
} else {
    $success = true;
}

//check for empty password
if (empty($_POST['pword'])) {
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



//SUCCESS
if ($success) {
    echo "<h1>Added Successfully</h1>";
    echo "<h2>Customer Records</h2>";
    echo "<h2>Customer Name : $newName </h2>";
    echo "<h2 >email  :   $email</h2>";
    echo "<h2 >phone no : $phoneno</h2>";
    echo "<h2 >role : $role</h2>";
    echo("<button onclick=\"location.href='customerprofile.php'\">Return to Customer record.</button>");
} else {
    echo "<h1>Oops!</h1>";
    echo "<h4>The following input errors were detected:</h4>";
    echo "<p>" . $errorMsg . "</p>";
    echo "<br>";
    echo("<button onclick=\"location.href='editcustomer.php'\">Return to  edit customer.</button>");
}

//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
