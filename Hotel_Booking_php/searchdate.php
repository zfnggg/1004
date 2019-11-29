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

    <!-- Personal StyleSheets & JS -->
    <link href="css/main.css" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/icon" href="./img/favicon.ico" />
    <link href="css/events.css" rel="stylesheet" />
    <link href="css/faq.css" rel="stylesheet" />
    <link href="css/dining.css" rel="stylesheet" />
    <script defer src="js/main.js"></script>

    <!-- Third Party -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
</head>

<body>

    <header>
        <?php
        include "./navbaruser.php";
        ?>
    </header>

    <main>
        <div class="jumbotron text-center">
            <h1>Search Booking Date</h1>
            <a href="customerprofile.php" title="manage">Customer</a> |
            <a href="booking.php" title="manage">Booking</a> |
            <a href="bookingsummary.php" title="manage">Booking Summary </a>
        </div>

        <div class="container-fluid text-center">
            <div class="row content">
                <div class="col-sm-2"></div>
                <div class="col-sm-8 text-left">
                    <form name="search" method="post" action="searchdate.php">
                        <label for="searchdate">Search Booking by Date:
                            <input type="date" id="searchdate" name="searchdate" required>
                        </label>
                        <button type="submit" class="btn btn-primary" onclick="myFunction()"> <span>Search </span></button>

                        <?php
                        require_once('../protected/config.php');

                        $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
                        ?>

                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td>Booking ID</td>
                                    <td>Check in Date</td>
                                    <td>Check out Date</td>
                                    <td>Room Type</td>
                                    <td>Status</td>

                                    <?php
                                    if (!isset($_GET['action'])) {

                                        $search = "%{$_POST['searchdate']}%";
                                        $flag = 0;
                                        $sql = $conn->prepare("select bookingID, checkin, checkout,roomType,status  from booking as b inner join rooms as r on b.roomID=r.roomID where checkin like ?");
                                        $sql->bind_param("s", $search);
                                        $sql->execute();
                                        $result = $sql->get_result();

                                        if (mysqli_num_rows($result) == 0) {
                                            echo "<h1>there are no results</h1>";
                                        }
                                        //                                    $result = mysqli_query($conn, $sql);
                                        //                                    $mycart = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                                        while ($data = mysqli_fetch_assoc($result)) {
                                            ?>
                                <tr>
                                    <td>
                                        <?php echo $data['bookingID'] ?>
                                    </td>
                                    <td>
                                        <?php echo $data['checkin'] ?>
                                    </td>
                                    <td>
                                        <?php echo $data['checkout'] ?>
                                    </td>
                                    <td>
                                        <?php echo $data['roomType'] ?>
                                    </td>
                                    <td>
                                        <?php echo $data['status'] ?>
                                    </td>
                                </tr>
                        <?php
                            }
                        }

                        mysqli_close($conn);
                        ?>
                            </table>
                        </div>
                    </form>
                </div>
                <div class="col-sm-2"></div>

            </div>
        </div>
    </main>

    <?php
    include "./footer.php";
    ?>

</body>


</html>