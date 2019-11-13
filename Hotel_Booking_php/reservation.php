<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
if (!isset($_SERVER['HTTP_REFERER'])) {
// redirect them to your desired location
    header('location:login.php');

    exit;
}
?>
<html lang="en">
    <head>
        <title>D'Hotel</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="shortcut icon" type="image/icon" href="./img/favicon.ico"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <!-- Main CSS Style Sheet-->
        <link href="css/main.css" rel = "stylesheet" /> 
        <!-- Zheng Feng CSS -->
        <!-- Events CSS Style Sheet-->
        <link href="css/events.css" rel = "stylesheet" /> 
        <!-- FAQ CSS Style Sheet-->
        <link href="css/faq.css" rel = "stylesheet" /> 
        <!-- Dining CSS Style Sheet-->
        <link href="css/dining.css" rel = "stylesheet" /> 
        <!-- Font Awesome Icons -->
        <script src='https://kit.fontawesome.com/a076d05399.js'></script> 
        <!-- Own Javascript -->
        <script defer src="js/main.js"></script>
    </head>

    <body>
        <!-- Start of Navigation Bar -->
        <div id="nav-placeholder">
            <script>
                $(function () {
                    $("#nav-placeholder").load("navbaruser.php");
                });
            </script>
        </div>
        <!--end of Navigation bar-->

        <?php
        session_start();
        $u = $_SESSION['MM_Username'];
        ?>

        <div class="jumbotron text-center">
            <h1>My Reservation  </h1>
            <h1>Hello and welcome back,  <?php echo $_SESSION['MM_Username']; ?></h1>
        </div>

        <div class="container-fluid text-center">    
            <div class="row content">
                <div class="col-sm-8 text-center"> 

                    <?php
                    define("DBHOST", "161.117.122.252");
                    define("DBNAME", "p1_4");
                    define("DBUSER", "p1_4");
                    define("DBPASS", "5xLMQfLGsc");

                    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
                    $sql = "select b.bookingID, c.customerName, r.roomType, b.checkin,b.checkout, b.numdays, b.total, b.pax from rooms as r "
                            . "inner join booking as b on r.roomID=b.roomID inner join customer as c on b.customerID=c.customerID where username = '$u'  ";
                    $mycart = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                    ?>

                    <table class="search_table">
                        <tr>
                            <th>Booking ID</th>
                            <th>Customer Name</th>
                            <th>Room Type</th>
                            <th>Check in Date</th>
                            <th>Check Out Date</th>
                            <th>Number of days</th>
                            <th>Total Charges ($)</th>
                            <th>Pax</th>
                        </tr>

                        <?php
                        while ($data = mysqli_fetch_assoc($mycart)) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $data['bookingID'] ?>
                                </td>
                                <td>
                                    <?php echo $data['customerName'] ?>
                                </td>
                                <td>
                                    <?php echo $data['roomType'] ?>
                                </td>
                                <td>
                                    <?php echo $data['checkin'] ?>
                                </td>
                                <td>
                                    <?php echo $data['checkout'] ?>
                                </td>
                                <td>
                                    <?php echo $data['numdays'] ?>
                                </td>
                                <td>
                                    <?php echo $data['total'] ?>
                                </td>
                                <td>
                                    <?php echo $data['pax'] ?>
                                </td>
                            </tr>
                            <?php
                        }
                        mysqli_close($conn);
                        ?>
                    </table>                 
                </div>
            </div>
        </div>
        <!--Footer-->
        <div id="footer-placeholder">
            <script>
                $(function () {
                    $("#footer-placeholder").load("footer.php");
                });
            </script>
        </div>
        <!--end of Footer-->
    </body>
</html>
