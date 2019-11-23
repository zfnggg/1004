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
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>-->
    <link href="css/main.css" rel="stylesheet" />
    <!-- Own CSS Style Sheet-->
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <!-- Font Awesome Icons -->
    <script defer src="js/main.js"></script>
    <!-- Own Javascript -->
</head>

<body>

    <header>
        <?php
        include "./navbaruser.php";
        ?>
    </header>

    <section class="jumbotron text-center">
        <h1>My Profile</h1>
    </section>

    <section class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-4"></div>
            <div class="col-sm-4 text-center">
                <br>
                <?php
                //session_start();
                $u = $_SESSION['MM_Username'];
                require_once('../protected/config.php');

                $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
                $sql = $conn->prepare("SELECT * FROM users WHERE username = ? ");
                $sql->bind_param("s", $u);
                $sql->execute();
                $result = $sql->get_result();
                //$search_result = mysqli_query($conn, $sql);
                $userrecord = mysqli_fetch_assoc($result);
                //mysqli_query($conn, $sql) or die(mysqli_error($conn));
                ?>

                <!-- onsubmit="return validateEditProfile()" -->
                <form name="formeditprofile" method="POST" action="editmyprofilerecord.php?action=add" enctype="multipart/form-data" novalidate>
                    <fieldset>
                        <table>
                            <tr>
                                <td>
                                    <label for="customerName">Customer Name:</label>
                                    <input type="text" id="customerName" name="customerName" required pattern="^(?=.{1,40}$)[a-zA-Z]+(?:[-'\s][a-zA-Z]+)*$" value="<?php echo $userrecord['customerName']; ?>">
                                    <input type="hidden" name="userID" value="<?php echo $userrecord['userID']; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="username">Username :</label>
                                    <input type="text" id="username" name="username" required pattern="^(?=.{1,40}$)[a-zA-Z]+(?:[-'\s][a-zA-Z]+)*$" value="<?php echo $userrecord['username']; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="password">Password:</label>
                                    <input type="password" name="password" id="password" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="email">Email:</label>
                                    <input type="text" id="email" name="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?php echo $userrecord['email']; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="phoneNo">Phone No:</label>
                                    <input type="text" id="phoneNo" name="phoneNo" required pattern="[6,8,9][0-9]{7}" value="<?php echo $userrecord['phoneNo']; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="profilePicture">Profile Picture:</label>
                                    <input type="file" name="profilePicture" id="profilePicture" accept=".png,.gif,.jpg,.webp" required>
                                </td>
                            </tr>
                        </table>

                        <input type="hidden" name="userID" value="<?php echo $userrecord['userID']; ?>">
                        <br>
                        <input type="submit" name="submit" value="Upload" class="btn btn-primary">
                    </fieldset>
                </form>

            </div>
            <div class="col-sm-4"></div>
        </div>
    </section>

    <?php
    include "./footer.php";
    ?>

</body>

</html>