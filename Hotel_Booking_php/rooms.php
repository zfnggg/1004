<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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

    <header>
        <?php
        include "./navbaruser.php";
        ?>

        <?php
        // = session_start();
        $r = "";
        if (isset($_SESSION['MM_Username'])) {
            $u = $_SESSION['MM_Username'];
            $r = $_SESSION['MM_role'];
        }
        ?>
    </header>

    <main>
    <article>
        <div class="jumbotron text-center">
            <h1>Rooms</h1>
            <form method="post">
                <?php
                if ($r == 'A') {
                    ?> <a href="./adminonly.php" title="manage">Manage</a>
                <?php
                }
                ?>
            </form>
            <p>Click <a href="./checkroom.php">Here</a> To Check Room Availability</p>
        </div>
    </article>


        <!--Display of Rooms-->
        <?php
        //require_once('/Applications/XAMPP/xamppfiles/protected/config.php');
        require_once('../protected/config.php');

        $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
        $sql = "select * from rooms";
        $mycart = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        ?>

        <div class="container-fluid">
            <div class="row">
                <?php
                while ($data = mysqli_fetch_assoc($mycart)) {
                    ?>
                    <div class="col-sm-4">
                        <img src="../HotelBooking_php/public_html/img/<?php echo $data['roomImg'] ?> " alt="room" style="width:100%">
                        <h1><?php echo $data['roomType'] ?></h1>
                        <span class="glyphicon glyphicon-user"></span>
                        <span class="glyphicon glyphicon-user"></span>
                        <span class="glyphicon glyphicon-bed"></span>

                        <form action="bookroom.php?id=<?php echo $data['roomID'] ?>" method="post" target="_blank">
                            <!--<input name="id" type="text" value="<?php echo $data['roomID'] ?>">-->
                            <input class="btn btn-primary" type="submit" name="submit" value="Show Prices">
                        </form>

                    </div>
                <?php
                }
                mysqli_close($conn);
                ?>
            </div>
        </div>
    </main>

    <?php
    include "./footer.php";
    ?>

</body>

</html>