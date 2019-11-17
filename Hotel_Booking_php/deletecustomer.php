<?php
if (!isset($_SERVER['HTTP_REFERER'])) {
// redirect them to your desired location
    header('location:login.php');
     
    exit;
}
?>
<?php

session_start();
require_once('/Applications/XAMPP/xamppfiles/protected/config.php');

$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
$cidToDelete = $_POST["cid"];
$sql = $conn->prepare("delete from customer where customerID=?");
$sql->bind_param("i", $cidToDelete);
$sql->execute();
$result = $sql->get_result();
$sql->close();
 mysqli_close($conn);
//$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
header("Location:customerprofile.php");
?>
