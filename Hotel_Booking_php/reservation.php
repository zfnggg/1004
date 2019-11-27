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
    <link rel="shortcut icon" type="image/icon" href="./img/favicon.ico" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Main CSS Style Sheet-->
    <link href="css/main.css" rel="stylesheet" />
    <!-- Zheng Feng CSS -->
    <!-- Events CSS Style Sheet-->
    <link href="css/events.css" rel="stylesheet" />
    <!-- FAQ CSS Style Sheet-->
    <link href="css/faq.css" rel="stylesheet" />
    <!-- Dining CSS Style Sheet-->
    <link href="css/dining.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <!-- Own Javascript -->
    <script defer src="js/main.js"></script>
</head>

<body>
    <header>
        <?php
        include "./navbaruser.php";
        ?>
    </header>

    <main>
        <?php
        //Session_start();
        $u = $_SESSION['MM_Username'];
        //require_once('/Applications/XAMPP/xamppfiles/protected/config.php');
        require_once('../protected/config.php');
        $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
        ?>

        <section>
            <div class="jumbotron text-center">
                <h1>My Reservation </h1>
                <h1>Welcome Back, <?php echo $_SESSION['MM_Username']; ?></h1>
                <?php
                $sqlpic = "select profilePicture from users where username = '$u'  ";
                $mycart1 = mysqli_query($conn, $sqlpic) or die(mysqli_error($conn));
                $data1 = mysqli_fetch_assoc($mycart1); ?>
                <img src="../Hotel_Booking_php/<?php echo $data1['profilePicture'] ?> " alt="image" width="100">
            </div>
        </section>

        <br>
        <section class="container-fluid text-center">
            <div class="row content">
                <div class="col-sm-2"></div>
                <div class="col-sm-8 text-center">

                    <?php

                    $sql = "select b.bookingID, c.customerName, r.roomType, b.checkin,b.checkout, b.numdays, b.total, b.pax from rooms as r "
                        . "inner join booking as b on r.roomID=b.roomID inner join users as c on b.userID=c.userID where username = '$u'  ";
                    $mycart = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                    ?>

                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Booking ID</th>
                                <th>Customer Name</th>
                                <th>Room Type</th>
                                <th>Check in Date</th>
                                <th>Check Out Date</th>
                                <th>Number of days</th>
                                <th>Total Charges ($)</th>
                                <th>Pax</th>
                                <th>Cancel Booking</th>
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
                                    <td>
                                        <form method="post" action="deletemybooking.php">
                                            <input name="cid" type="hidden" value="<?php echo $data['bookingID'] ?>">
                                            <input type="submit" value="Delete">
                                        </form>
                                    </td>

                                </tr>

                            <?php
                            }

                            mysqli_close($conn);
                            ?>
                        </table>
                    </div>
                </div>
                <div class="col-sm-2"></div>
            </div>
        </section>
    </main>

    <?php
    include "./footer.php";
    ?>

</body>

</html>