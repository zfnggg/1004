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
    <!-- Start of Navigation Bar -->
    <div id="nav-placeholder">
        <script>
            $(function() {
                $("#nav-placeholder").load("navbaruser.php");
            });

        </script>
    </div>
    <!--end of Navigation bar-->

    <div class="jumbotron text-center">
        <h1>Booking Summary</h1>
        <a href="customerprofile.php" title="manage">Customer</a> |
        <a href="booking.php" title="manage">Booking</a> |
        <a href="bookingsummary.php" title="manage">Booking Summary </a>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4">
                <form method="post" action="bookingsummary.php">
                    <label for="searchdate">View Summary of Booking by Date:
                        <input type="date" id="searchdate" name="searchdate">
                    </label>
                    <label for="myWeek">View Summary of Booking by Week:
                        <input type="date" name="searchweek" id="myWeek" value="2019-W01">
                    </label>
                    <label for="searchmonth">View Summary of Booking by Month:
                        <input type="date" id="searchmonth" name="searchmonth">
                    </label>
                    <label for="total">
                        <input type="radio" id="total" name="total">Total No of bookings per day, per week, per month
                    </label>
                    <button type="submit" name="submit" class="button"> <span>Submit </span></button>


                    <?php
                         require_once('/Applications/XAMPP/xamppfiles/protected/config.php');

                        $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
                        ?>

                    <?php
                        if (isset($_POST['submit']) and ( $_POST['searchdate'] != "")) {
                            ?>
                    <table class="table_summary">
                        <tr>
                            <td>Check-in (Date)</td>
                            <td>Room Type</td>
                        </tr>
                        <?php
                                $search = "%{$_POST['searchdate']}%";
                                $flag = 0;
                                $sql = $conn->prepare("select checkin, roomType from booking as b inner join rooms as r on b.roomID=r.roomID where date(checkin) like ?");
                                $sql->bind_param("s", $search);
                                $sql->execute();
                                $result = $sql->get_result();
                                $sql->close();
                                //$result = mysqli_query($conn, $sql);
                                //$mycart = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                                while ($data = mysqli_fetch_assoc($result)) {
                                    ?>
                        <tr>
                            <td>
                                <?php echo $data['checkin'] ?>
                            </td>
                            <td>
                                <?php echo $data['roomType'] ?>

                            </td>
                        </tr>
                        <?php
                                }
                                ?>
                    </table>
                    <?php
                        }
                        mysqli_close($conn);
                        ?>

                    <?php
                        $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
                        ?>
                    <?php
                        if (isset($_POST['submit']) and ( $_POST['searchweek'] != "")) {
                            ?>
                    <table class="table_summary">
                        <tr>
                            <td>Check-in (Week)</td>
                            <td>Room Type</td>
                        </tr>
                        <?php
                                //$search = $_POST["searchweek"];
                                $search = $_POST['searchweek'];
                                $flag = 0;
                                $s = explode("-W0", $search);
                                $sql = $conn->prepare("select week(checkin) as weekNo , roomType from booking as b inner join rooms as r on b.roomID=r.roomID where week(checkin) = week(?)");
                                $sql->bind_param("s", $search);
                                $sql->execute();
                                $result = $sql->get_result();
                                $sql->close();
                                //$result = mysqli_query($conn, $sql);
                                //$mycart = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                                while ($data = mysqli_fetch_assoc($result)) {
                                    ?>
                        <tr>
                            <td>
                                Week <?php echo $data['weekNo'] ?>
                            </td>
                            <td>

                                <?php echo $data['roomType'] ?>

                            </td>
                        </tr>
                        <?php
                                }
                                ?>
                    </table>
                    <?php
                        }
                        mysqli_close($conn);
                        ?>

                    <?php
                        $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
                        ?>
                    <?php
                        if (isset($_POST['submit']) and ( $_POST['searchmonth'] != "")) {
                            ?>
                    <table class="table_summary">
                        <tr>
                            <td>Check in (MONTH)</td>
                            <td>Room Type</td>
                        </tr>

                        <?php
                                $search = $_POST["searchmonth"];
                                $flag = 0;
                                $sql = $conn->prepare("select DATE_FORMAT(checkin, '%b %y') as month, roomType from booking as b inner join rooms as r on b.roomID=r.roomID where month(checkin) = month(?)");
                                $sql->bind_param("s", $search);
                                $sql->execute();
                                $result = $sql->get_result();
                                $sql->close();
                                //$result = mysqli_query($conn, $sql);
                                //$mycart = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                                while ($data = mysqli_fetch_assoc($result)) {
                                    ?>
                        <tr>
                            <td>
                                <?php echo $data['month'] ?>
                            </td>
                            <th>
                                <?php echo $data['roomType'] ?>
                            </th>
                        </tr>
                        <?php
                                }
                                ?>
                    </table>
                    <?php
                        }
                        mysqli_close($conn);
                        ?>

                    <?php
                        $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
                        ?>
                    <?php
                        if (isset($_POST['submit']) and ( isset($_POST['total']))) {
                            ?>
                    <table class="table_summary">
                        <tr>
                            <td>Total Bookings per Day</td>
                            <td>Total Bookings per Week</td>
                            <td>Total Bookings per Month</td>
                        </tr>

                        <?php
                                $search = $_POST["total"];
                                $month = $_POST["searchmonth"];
                                $week = $_POST["searchweek"];
                                $date = "%{$_POST['searchdate']}%";
                                $s = explode("-W0", $week);
                                $m = explode("2019-0", $month);
                                $flag = 0;
                                $sql = $conn->prepare("SELECT count(case when date(checkin) like ? then 1 end) as d,
                           count(case when week(checkin) like week(?) then 1 end) as m ,
                        count(case when  month(checkin) like month(?) then 1 end) as w
                              FROM booking ");
                                $sql->bind_param("sss", $date, $week, $month);
                                $sql->execute();
                                $result = $sql->get_result();
                                $sql->close();
                                //$result = mysqli_query($conn, $sql);
                                //$mycart = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                                while ($data = mysqli_fetch_assoc($result)) {
                                    ?>
                        <tr>
                            <td>
                                <?php echo $data['d'] ?>
                            </td>
                            <td>
                                <?php echo $data['m'] ?>

                            </td>
                            <td>
                                <?php echo $data['w'] ?>
                            </td>
                        </tr>
                        <?php
                                }
                                ?>
                    </table>
                    <?php
                        }
                        mysqli_close($conn);
                        ?>
                </form>
            </div>
        </div>
    </div>

    <!--Footer-->
    <div id="footer-placeholder">
        <script>
            $(function() {
                $("#footer-placeholder").load("footer.php");
            });

        </script>
    </div>
    <!--end of Footer-->
</body>

</html>
