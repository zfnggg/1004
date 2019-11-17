<!DOCTYPE html>
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

    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <h2 class="text-center">Available Rooms</h2>
            <?php
               require_once('/Applications/XAMPP/xamppfiles/protected/config.php');

                $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
                ?>

            <?php
                if (isset($_POST['submit'])) {
                    ?>
            <table class="table_summary">
                <tr>
                    <td>Room Type</td>
                    <td>Check-in (Date)</td>
                    <td>Check-out (Date)</td>
                </tr>
                <?php
                        $checkin = $_POST['checkin'];
                        $checkout = $_POST['checkout'];
                        $sql = $conn->prepare("select r.roomType, b.checkin,b.checkout from booking as b inner join rooms as r on b.roomID=r.roomID where date(checkin) <= ? and checkout > ? group by r.roomID");
                        $sql->bind_param("ss", $checkin, $checkout);
                        $sql->execute();
                        $result = $sql->get_result();
                        if (mysqli_num_rows($result) == 0) {
                            echo "<h1>there are no results</h1>";
                        }
                        while ($data = mysqli_fetch_assoc($result)) {
                            ?>
                <tr>
                    <td>
                        <?php echo $data['roomType'] ?>
                    </td>
                    <td>
                        <?php echo $data['checkin'] ?>

                    </td>
                    <td>
                        <?php echo $data['checkout'] ?>

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
        </div>
        <div class="col-sm-1"></div>
    </div>

    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10 text-center">
            <p>Click <a href="./rooms.php">here</a> to return</p>
            <div class="col-sm-1"></div>
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
