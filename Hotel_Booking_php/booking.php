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
        <h1>Booking</h1>
        <a href="customerprofile.php" title="manage">Customer</a> |
        <a href="bookingsummary.php" title="manage">Booking Summary </a>
    </div>

    <div class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-8 text-left">
                <a href="searchdate.php?action=add" title="">Search Booking by Date</a>
                <br />
                <a href="searchusername.php?action=add" title="">Search Booking by Username</a>

                <?php
                     require_once('/Applications/XAMPP/xamppfiles/protected/config.php');
                    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
                    $sql = "select * from rooms as r inner join booking as b on r.roomID = b.roomID inner join users as c on b.userID = c.userID";
                    $mycart = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                    ?>

                <table class="search_table">
                    <tr>
                        <th>Booking ID</th>
                        <th>Room Type</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Check in</th>
                        <th>Check out</th>
                        <th>Total Charges</th>
                        <th>Pax</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>

                    <?php
                        while ($data = mysqli_fetch_assoc($mycart)) {
                            ?>
                    <tr>
                        <td>
                            <?php echo $data['bookingID'] ?>
                        </td>
                        <td>
                            <?php echo $data['roomType'] ?>
                        </td>
                        <td>
                            <?php echo $data['customerName'] ?>
                        </td>
                        <td>
                            <?php echo $data['email'] ?>
                        </td>
                        <td>
                            <?php echo $data['phoneNo'] ?>
                        </td>
                        <td>
                            <?php echo $data['checkin'] ?>
                        </td>
                        <td>
                            <?php echo $data['checkout'] ?>
                        </td>
                        <td>
                            $<?php echo $data['total'] ?>
                        </td>
                        <td>
                            <?php echo $data['pax'] ?>
                        </td>
                        <td>
                            <form method="post" action="deletebooking.php">
                                <input name="cid" type="hidden" value="<?php echo $data['bookingID'] ?>">
                                <input type="submit" value="delete">
                            </form>
                        </td>

                        <td>
                            <form name="booking" method="post" action="editbookingrecord.php">
                                <input name="cid" type="hidden" value="<?php echo $data['bookingID'] ?>">
                                <br />
                                <label>Status:
                                    <input type="text" pattern="^(?=.{1,40}$)[a-zA-Z]+(?:[-'\s][a-zA-Z]+)*$" name="name" value="<?php echo $data['status'] ?>" required></label>
                                <br />
                                <input type="submit" name="submit" value="update" onclick="myFunction()">
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
    </div>

    <script>
        function myFunction() {

            var status = document.forms["booking"]["name"];


            if (status.value === "")

            {
                alert("Status must not be empty");
                return false;
            } else {
                window.alert("Updated Successfully ! ");
                return true;
            }
        }

    </script>

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
