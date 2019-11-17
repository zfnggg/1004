<?php

if (!isset($_SERVER['HTTP_REFERER'])) {
// redirect them to your desired location
    header('location:login.php');

    exit;
}
?>
<?php

require_once('/Applications/XAMPP/xamppfiles/protected/config.php');

$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

if (isset($_POST["submit"])) {
    $cidToUpdate = $_POST["cid"];
    $newName = $_POST["name"];


    $sql = $conn->prepare("update booking set status = ? where bookingID = ?");
    $sql->bind_param("si", $newName, $cidToUpdate);
    $sql->execute();
    $sql->close();
    //header("Location:booking.php?id=$cidToUpdate");
    mysqli_close($conn);
}
?>

<?php

$newName = $errorMsg = "";
$success = true;

//customer Name
if (empty($_POST['name'])) {
    $errorMsg .= "status is required.<br>";
    $success = false;
} else {
    $newName = sanitize_input($_POST["name"]);
    $success = true;
}

//SUCCESS
if ($success) {
    echo "<h1>Updated Successfully</h1>";
    echo "<h2>Status : $newName </h2>";
    echo("<button onclick=\"location.href='booking.php?id=$cidToUpdate'\">Return to Booking record.</button>");
} else {
    echo "<h1>Oops!</h1>";
    echo "<h4>The following input errors were detected:</h4>";
    echo "<p>" . $errorMsg . "</p>";
    echo "<br>";
    echo("<button onclick=\"location.href='booking.php?id=$cidToUpdate'\">Return to booking.</button>");
}

//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
