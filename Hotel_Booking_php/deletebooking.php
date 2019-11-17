<?php

if (!isset($_SERVER['HTTP_REFERER'])) {
// redirect them to your desired location
    header('location:login.php');

    exit;
}
?>
<?php


require_once('../protected/config.php');
$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

$cidToDelete = $_POST["cid"];
$sql = $conn->prepare("delete from booking where bookingID=?");
$sql->bind_param("i", $cidToDelete);
$sql->execute();
$result = $sql->get_result();
$sql->close();
 mysqli_close($conn);
//$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
header("Location:booking.php?id=$cidToDelete");
?>
