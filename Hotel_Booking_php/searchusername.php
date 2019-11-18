<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
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
        <div class="jumbotron text-center">
            <h1>Search Username </h1>
            <a href="customerprofile.php" title="manage">Customer</a> |
            <a href="booking.php" title="manage">Booking</a> |
            <a href="bookingsummary.php" title="manage">Booking Summary </a>
        </div>

        <section>
            <div class="container-fluid text-center">
                <div class="row content">
                    <div class="col-sm-8 text-centre">
                        <form name="search" method="post" action="searchusername.php">
                            <label for="search">Search Booking by Username:
                                <input type="text" id="search" pattern="^(?=.{1,40}$)[a-zA-Z]+(?:[-'\s][a-zA-Z]+)*$" name="search" size="40" required />

                            </label>
                            <button type="submit" class="btn btn-primary" onclick="myFunction()"> <span>Search </span></button>
                        </form>

                        <hr>
                        <?php
                        //require_once('/Applications/XAMPP/xamppfiles/protected/config.php');
                        require_once('../protected/config.php');

                        $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
                        ?>

                       <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <td>Booking ID</td>
                                <td>Username</td>
                                <td>Room Type</td>
                                <td>Status</td>

                                <?php
                                if (!isset($_GET['action'])) {

                                    $search = "%{$_POST['search']}%";
                                    $flag = 0;
                                    $sql = $conn->prepare("select bookingID, username, roomType, status from booking as b inner join rooms as r on b.roomID=r.roomID inner join users as c on b.userID = c.userID where username like ? ");
                                    $sql->bind_param("s", $search);
                                    $sql->execute();
                                    $result = $sql->get_result();
                                    //                                    $sql->close();

                                    if (mysqli_num_rows($result) == 0) {
                                        echo "<h1>there are no results</h1>";
                                    }

                                    //$result = mysqli_query($conn, $sql);
                                    //$mycart = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                                    while ($data = mysqli_fetch_assoc($result)) {
                                        ?>
                            <tr>
                                <td>
                                    <?php echo $data['bookingID'] ?>
                                </td>
                                <td>
                                    <?php echo $data['username'] ?>
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
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php
    include "./footer.php";
    ?>
</body>

</html>
