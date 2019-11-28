<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">

<head>
    <title>D'Hotel</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/icon" href="./img/favicon.ico" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Main CSS Style Sheet-->
    <link href="css/main.css" type="text/css" rel="stylesheet" />
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

        if (!isset($_SERVER['HTTP_REFERER'])) {
            // redirect them to your desired location
            header('location:login.php');
            exit;
        }
        //CRF Token 
        $_SESSION['_token'] = bin2hex(openssl_random_pseudo_bytes(16));

        ?>
    </header>

    <main>
        <section class="jumbotron text-center">
            <h1>Customer Profile</h1>
            <a href="booking.php" title="manage">Booking</a> |
            <a href="bookingsummary.php" title="manage">Booking Summary</a>
        </section>

        <section class="container-fluid text-center">
            <div class="row content">
                <div class="col-sm-8 text-left">
                    <a href="addcustomer.php?action=add" title="">
                        <h2>Add Customer</h2>
                    </a>
                    <br />
                    <a href="searchcustomer.php?action=add" title="">
                        <h2>Search Customer</h2>
                    </a>
                    <br>

                    <?php
                    require_once('../protected/config.php');
                    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
                    $sql = "select * from users";
                    $mycart = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                    ?>

                    <div class="table-responsive-sm">
                        <table class="table">
                            <tr>
                                <th>customer ID</th>
                                <th>Customer Name</th>
                                <th>Username</th>

                                <th>Email</th>
                                <th>Phone No</th>
                                <th>Role</th>
                                <th>Profile Picture</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>

                            <?php
                            while ($data = mysqli_fetch_assoc($mycart)) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $data['userID'] ?>
                                    </td>
                                    <td>
                                        <?php echo $data['customerName'] ?>
                                    </td>
                                    <td>
                                        <?php echo $data['username'] ?>
                                    </td>

                                    <td>
                                        <?php echo $data['email'] ?>
                                    </td>
                                    <td>
                                        <?php echo $data['phoneNo'] ?>
                                    </td>
                                    <td>
                                        <?php echo $data['role'] ?>
                                    </td>
                                    <td>
                                        <figure>
                                            <img src="../Hotel_Booking_php/<?php echo $data['profilePicture'] ?> " alt="" width="100">
                                        </figure>
                                    </td>
                                    <td>
                                        <form method="post" action="deletecustomer.php">
                                            <input name="cid" type="hidden" value="<?php echo $data['userID'] ?>">
                                            <input type="hidden" name="_token" value="<?php echo $_SESSION['_token'] ?>">
                                            <input type="submit" value="delete">
                                        </form>
                                    </td>
                                    <td>
                                        <a href="editcustomer.php?id=<?php echo $data['userID'] ?>">Edit</a>
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
        </section>
    </main>

    <?php
    include "./footer.php";
    ?>
</body>

</html>