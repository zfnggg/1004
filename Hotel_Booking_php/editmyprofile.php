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

<!-- Start of Navigation Bar -->
<div id="nav-placeholder">
    <script>
        $(function() {
            $("#nav-placeholder").load("navbaruser.php");
        });

    </script>
</div>
<!--end of Navigation bar-->

<body>
    <div class="jumbotron text-center">
        <h1>My Profile</h1>
    </div>

    <div class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-8 text-center">

                <?php
                session_start();
                $u = $_SESSION['MM_Username'];
           require_once('../xampp/protected/config.php');

                $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
                $sql = $conn->prepare("SELECT * FROM users WHERE username = ? ");
                $sql->bind_param("s", $u);
                $sql->execute();
                $result = $sql->get_result();
//                $search_result = mysqli_query($conn, $sql);
                $userrecord = mysqli_fetch_assoc($result);
//                mysqli_query($conn, $sql) or die(mysqli_error($conn));
                ?>

                <form name="formeditprofile" onsubmit="return validateEditProfile()" novalidate method="POST" action="editmyprofilerecord.php?action=add" enctype="multipart/form-data">
                    <table>
                        <tr>
                            <td>
                                <label for="customerName">Customer Name:

                                    <input type="text" id="customerName" name="customerName" required pattern="^(?=.{1,40}$)[a-zA-Z]+(?:[-'\s][a-zA-Z]+)*$" value="<?php echo $userrecord['customerName']; ?>">
                                </label>
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
                                <label for="password">Password:

                                    <input type="password" name="password" id="password" value="<?php echo $userrecord['password']; ?>"></label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="email">Email:</p>

                                    <input type="text" id="email" name="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?php echo $userrecord['email']; ?>">
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="phoneNo">
                                    Phone No:

                                    <input type="text" id="phoneNo" name="phoneNo" required pattern="[6,8,9][0-9]{7}" value="<?php echo $userrecord['phoneNo']; ?>"></label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="profilePicture">Profile Picture:

                                    <input type="file" name="profilePicture" id="profilePicture" accept=".png,.gif,.jpg,.webp" required></label>
                            </td>
                        </tr>
                    </table>
                    <input type="hidden" name="userID" value="<?php echo $userrecord['userID']; ?>">
                    <input type="submit" name="submit" value="Upload" class="btn btn-primary">
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
