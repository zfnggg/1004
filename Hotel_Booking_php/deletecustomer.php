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

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (!isset($_POST['_token']) || ($_POST['_token'] != $_SESSION['_token'])){
        die('Invalid Token or Request Method');
    }
}


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
