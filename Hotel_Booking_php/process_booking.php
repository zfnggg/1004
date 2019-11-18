<?php

if (!isset($_SERVER['HTTP_REFERER'])) {
// redirect them to your desired location
    header('location:login.php');

    exit;
}
?>
<?php

if (!isset($_['submit'])) {
    $userID = $_POST['userID'];
    $roomID = $_POST['roomID'];
    $checkin = $_POST['check_in'];
    $checkout = $_POST['check_out'];
    $total = $_POST['total_sum'];
    $num_days = $_POST['num_days'];
    $status = $_POST['status'];
    $pax = $_POST['pax'];


require_once('../protected/config.php');

    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

    $sql = $conn->prepare("insert into booking (userID,roomID,checkin,checkout,total,numdays,status,pax) values (?,?,?,?,?,?,?,?)");
    $sql->bind_param("iissiisi", $userID, $roomID, $checkin, $checkout, $total, $num_days, $status, $pax);
    $sql->execute();
    $result = $sql->get_result();
    $sql->close();
    mysqli_close($conn);
    //header("Location:bookroom.php?id=$roomID");
}
?>

<?php

$email = $errorMsg = "";
$checkin = sanitize_input($_POST["check_in"]);
$checkout = sanitize_input($_POST['check_out']);
$total = sanitize_input($_POST['total_sum']);
$num_days = sanitize_input($_POST['num_days']);
$success = true;

//check_in
if (empty($_POST['check_in'])) {
    $errorMsg .= "check in  is required.<br>";
    $success = false;
} else {
    $checkin = sanitize_input($_POST["check_in"]);
    $success = true;
}

//check_out
if (empty($_POST['check_out'])) {
    $errorMsg .= "check_out  is required.<br>";
    $success = false;
} else {
    $checkout = sanitize_input($_POST["check_out"]);
    $success = true;
}

//check for empty total_sum
if (empty($_POST['total_sum'])) {
    $errorMsg .= "total sum is required.<br>";
    $success = false;
} else {
    $total = sanitize_input($_POST["total_sum"]);
    $success = true;
}

//check for empty pax
if (empty($_POST['pax'])) {
    $errorMsg .= "Pax is required.<br>";
    $success = false;
} else {
    $pax = sanitize_input($_POST["pax"]);
    $success = true;
}

//check for empty num_days
if (empty($_POST['num_days'])) {
    $errorMsg .= "num days is required.<br>";
    $success = false;
} else {
    $num_days = sanitize_input($_POST["num_days"]);
    $success = true;
}


//SUCCESS
if ($success) {
    echo "<h1>Booking Successful</h1>";
    echo "<h2>Customer ID : $userID </h2>";
    echo "<h2>Room ID : $roomID </h2>";
    echo "<h2 >Checkin  :   $checkin</h2>";
    echo "<h2 >Checkout : $checkout</h2>";
    echo "<h2 >Total : $total</h2>";
    echo "<h2 >Num of days : $num_days</h2>";
    echo "<h2 >Num of pax : $pax</h2>";
    echo("<button onclick=\"location.href='bookroom.php?id=$roomID'\">Return to Booking.</button>");
} else {
    echo "<h1>Oops!</h1>";
    echo "<h4>The following input errors were detected:</h4>";
    echo "<p>" . $errorMsg . "</p>";
    echo "<br>";
    echo("<button onclick=\"location.href='bookroom.php?id=$roomID'\">Return to Booking.</button>");
}

//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

