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

    <link type="text/css" href="css/main.css" rel="stylesheet" />

    <link type="text/css" href="css/main.css" rel="stylesheet" />


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
        <nav>
            <?php
            include "./navbaruser.php";
            ?>
        </nav>
    </header>

    <main>
        <section>
            <div class="jumbotron text-center">
                <h1>Search Customer</h1>
                <a href="customerprofile.php" title="manage">Customer</a> |
                <a href="booking.php" title="manage">Booking</a> |
                <a href="bookingsummary.php" title="manage">Booking Summary </a>
            </div>
        </section>

        <section>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <form name="myForm" method="post" action="searchcustomer.php">

                            <label for="search">Search Customer Name :
                                <input type="text" id="search" name="search" size="40" pattern="^(?=.{1,40}$)[a-zA-Z]+(?:[-'\s][a-zA-Z]+)*$" required />

                            </label>
                            <input type="submit" value="Search" class="btn btn-primary" onclick="myFunction()">

                            <?php
                            //require_once('/Applications/XAMPP/xamppfiles/protected/config.php');
                            require_once('../protected/config.php');

                            $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
                            ?>
                            <hr>

                            <table class="search_table">
                                <tr>
                                    <td>Customer ID</td>
                                    <td>Customer Name</td>
                                    <?php
                                    if (!isset($_GET['action'])) {

                                        $search = "%{$_POST['search']}%";
                                        $flag = 0;
                                        $sql = $conn->prepare("select * from users where customerName like ? ");
                                        $sql->bind_param("s", $search);
                                        $sql->execute();
                                        $result = $sql->get_result();
                                        $sql->close();

                                        if (mysqli_num_rows($result) == 0) {
                                            echo "there are no results";
                                        }

                                        //$result = mysqli_query($conn, $sql);
                                        //$mycart = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                                        while ($data = mysqli_fetch_assoc($result)) {
                                            ?>
                                <tr>
                                    <td>
                                        <?php echo $data['userID'] ?>
                                    </td>
                                    <td>
                                        <?php echo $data['customerName'] ?>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        mysqli_close($conn);
                        ?>
                            </table>
                        </form>
                    </div>
                    <div class="col-sm-4"></div>
                </div>

            </div>

        </section>

    </main>

    <footer>
        <?php
        include "./footer.php";
        ?>
    </footer>

</body>
</html>