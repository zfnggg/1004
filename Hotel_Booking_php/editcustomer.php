<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include "./navbaruser.php";

?>
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
   
    <div class="jumbotron text-center">
        <h1>Edit Profile</h1>
        <a href="customerprofile.php" title="manage">Customer</a> |
        <a href="booking.php" title="manage">Booking</a> |
        <a href="bookingsummary.php" title="manage">Booking Summary </a>
    </div>

    <div class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-8 text-left">

                <?php
                  require_once('/Applications/XAMPP/xamppfiles/protected/config.php');

                    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
                    $option = $_GET['id'];
                    $sql = $conn->prepare("select  *  from users where userID = ? ");
                    $sql->bind_param("i", $option);
                    $sql->execute();
                    $result = $sql->get_result();
                    //$mycart = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                    ?>

                <?php
                    while ($data = mysqli_fetch_assoc($result)) {
                        ?>
                <form method="post" name="editcust" action="editcustomerrecord.php?action=add" enctype="multipart/form-data">
                    <table>
                        <tr>
                            <td>
                                <label for="cName"> Customer Name:
                                    <input id="cName" name="cName" pattern="^(?=.{1,40}$)[a-zA-Z]+(?:[-'\s][a-zA-Z]+)*$" type="text" value="<?php echo $data['customerName'] ?>">
                                    <input name="cid" type="hidden" value="<?php echo $data['userID'] ?>">
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="password">Password:<input type="password" id="password" name="pword" value="<?php echo $data['password'] ?>"></label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="email">Email :<input type="text" id="email" name="email" pattern="^\S+@\S+$" value="<?php echo $data['email'] ?>"></label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="phone">Phone No: <input type="text" id="phone" name="phone" pattern="[6,8,9][0-9]{7}" value="<?php echo $data['phoneNo'] ?>"></label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="roleC"> Role: <br />
                                    <input type="radio" id="roleC" name="role" value="C" required> Customer<br>
                                </label>
                                <label for="roleA">
                                    <input type="radio" id="roleA" name="role" value="A" required> Admin<br>
                                </label>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="profilePicture"> Profile Pic:
                                    <img src="../Hotel_Booking_php/<?php echo $data['profilePicture'] ?> " width="100" alt="">
                                    <input type="file" name="profilePicture" id="profilePicture" accept=".png,.gif,.jpg,.webp" required>
                                </label>
                            </td>
                        </tr>
                    </table>
                    <button type="submit" name="submit" value="Upload" class="btn btn-primary" onclick="myFunction()">Update</button>
                </form>
                <?php
                    }
                    $sql->close();
                    mysqli_close($conn);
                    ?>
            </div>
        </div>
    </div>

    <script>
        function myFunction() {

            var customerName = document.forms["editcust"]["cName"];
            var email = document.forms["editcust"]["email"];
            var regexEmail = /\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/;
            var password = document.forms["editcust"]["pword"];
            var phoneNo = document.forms["editcust"]["phone"];
            var role = document.forms["editcust"]["role"];
            var profilepic = document.forms["editcust"]["profilePicture"];

            if (customerName.value === "") {
                window.alert("Please enter customer name.");

                return false;
            }

            if (username.value === "") {
                window.alert("Please enter username.");

                return false;
            }
            if (phoneNo.value === "") {
                window.alert("Please enter phone number.");

                return false;
            }
            if (role.value === "") {
                window.alert("Please select role.");

                return false;
            }
            if (profilepic.value === "") {
                window.alert("Please upload profile picture.");

                return false;
            }

            if (email.value === "") {
                window.alert("Please enter a valid e-mail address.");

                return false;
            } else if (regexEmail.test(email.value)) {
                window.alert("Valid Email");

            } else {
                window.alert("Not valid email");
                return false;
            }
            if (password.value === "")

            {
                alert("Password must not be empty");
                return false;
            } else if (password.value !== confirmpwd.value) {
                window.alert("Passwords Don't Match");
                return false;
            } else {
                window.alert("edied");
                return true;
            }

        }

    </script>

    <?php
            include "./footer.php";
            ?>

    </html>
</body>

</html>
