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
        <link rel="shortcut icon" type="image/icon" href="./img/favicon.ico"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <!-- Main CSS Style Sheet-->
        <link href="css/main.css" rel = "stylesheet" /> 
        <!-- Zheng Feng CSS -->
        <!-- Events CSS Style Sheet-->
        <link href="css/events.css" rel = "stylesheet" /> 
        <!-- FAQ CSS Style Sheet-->
        <link href="css/faq.css" rel = "stylesheet" /> 
        <!-- Dining CSS Style Sheet-->
        <link href="css/dining.css" rel = "stylesheet" /> 
        <!-- Font Awesome Icons -->
        <script src='https://kit.fontawesome.com/a076d05399.js'></script> 
        <!-- Own Javascript -->
        <script defer src="js/main.js"></script>
    </head>

    <body>
        <!-- Start of Navigation Bar -->
        <div id="nav-placeholder">
            <script>
                $(function () {
                    $("#nav-placeholder").load("navbaruser.php");
                });
            </script>
        </div>
        <!--end of Navigation bar-->

        <!--check if user is logged in when clicked on Show Price else go to login page-->

        <?php
        session_start();
        $u = $_SESSION['MM_Username'];
        define("DBHOST", "161.117.122.252");
        define("DBNAME", "p1_4");
        define("DBUSER", "p1_4");
        define("DBPASS", "5xLMQfLGsc");
        $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
        $option = $_GET['id'];
        $sql = "select  *  from rooms where roomID =$option";
        $mycart = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $data = mysqli_fetch_assoc($mycart)
        ?>

        <div class="jumbotron text-center">
            <h1><?php echo $data['roomType'] ?></h1>
            <p>$<?php echo $data['price'] ?> per day</p>
            <h3><?php
                if (isset($_SESSION['MM_Username']) && $_SESSION['MM_Username'] == true) {
                    $welcomeMessage = "Welcome " . $_SESSION['MM_Username'] . "!";
                    echo "$welcomeMessage";
                } else {
                    header('Location: login.php');
                }
                ?>
            </h3>
        </div>
        <!---- rooms--->
        <div class="container-fluid">
            <div class="row content">
                <div class="col-sm-8">  
                    <h2><?php echo $data['roomType'] ?></h2>                 
                    <img src="../HotelBooking_php/public_html/img/<?php echo $data['roomImg'] ?> " style="width:100%">
                    <br><br>
                </div>

                <div class="col-sm-4 payment">
                    <div id="booknow">
                        <?php
                        $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
                        $customersql = "SELECT * FROM customer WHERE username = '$u' ";
                        $mycustomer = mysqli_query($conn, $customersql);
                        $customer = mysqli_fetch_assoc($mycustomer);
                        mysqli_query($conn, $customersql) or die(mysqli_error($conn));
                        ?>

                        <form method="POST" name="bookroom" action="process_booking.php" >
                            <h3>Total Payment:</h3>                          
                            <p>Check in: <input type="date" id="checkin" name="check_in" required onchange="cal()"></p>
                            <p>Check out: <input type="date" id="checkout" name="check_out" required onchange="cal()"></p>
                            <p>No of days: <input type="text" id="numdays" name="num_days" readonly required></p>
                            <p>Total Charges:$ <input type="text"  id="total" name="total_sum" readonly/></p>
                            <input type="hidden"  id="status" name="status" value="going" readonly/>
                            
                            <h3>Personal Information:</h3>
                            <p>Name : <input type="text" name="customerName" value="<?php echo $customer['customerName']; ?>"></p>                       
                            <input type="hidden" name="customerID" value="<?php echo $customer['customerID']; ?>">
                            <input  type="hidden" name="roomID" value="<?php echo $data['roomID'] ?>">
                            <h3>Payment Details:</h3>
                            <h4>Accepted Cards</h4>
                            <div class="icon-container">
                                <i class="fa fa-cc-visa" style="color:navy;"></i>
                                <i class="fa fa-cc-amex" style="color:blue;"></i>
                                <i class="fa fa-cc-mastercard" style="color:red;"></i>
                                <i class="fa fa-cc-discover" style="color:orange;"></i>
                            </div>
                            <p>Credit card: <input type="text" name="cardnumber" maxlength="16" pattern="^[0-9]{16}$" placeholder="4444-2222-3333-1111" required></p>
                            <p>Valid Thru: <input type="month" id="expmonth" name="expmonth" value="2019-11" placeholder="Sep" required></p>
                            <p>CVV: <input type="numer" id="cvv" name="cvv" maxlength="3" pattern="^[0-9]{3}$" placeholder="352" required></p>
                            <input type="submit" name="submit" class="btn btn-primary" onclick="myFunction()">
                        </form>

                        <script type="text/javascript">

                            //--------------------------credit card-------------------------------------

                            //-----------------------------date-----------------------------------------
                            //greyed out dates before today
                            var today = new Date().toISOString().split('T')[0];
                            document.getElementsByName("check_in")[0].setAttribute('min', today);

                            //prevent user from selecting date 
                            var checkIn = document.getElementById('checkin');
                            var checkOut = document.getElementById('checkout');
                            checkIn.addEventListener('change', updatedate);

                            function updatedate() {
                                var firstdate = checkIn.value;
                                checkOut.min = firstdate;
                            }

                            var checkin = document.forms["bookroom"]["checkin"];
                            var checkout = document.forms["bookroom"]["checkout"];

                            var creditcard = document.forms["bookroom"]["cardnumber"];
                            var regexcc = /^[0-9]{16}$/;

                            var cvv = document.forms["bookroom"]["cvv"];
                            var regexcvv = /^[0-9]{3}$/;

                            function myFunction() {

                                if (checkin.value === "")
                                {
                                    window.alert("Check in date is empty");
                                    return false;
                                }

                                if (checkout.value === "")
                                {
                                    window.alert("Check out date is empty");
                                    return false;
                                }

                                if (creditcard.value === "")
                                {
                                    window.alert("creditcard is empty");
                                    return false;
                                } else if (regexcc.test(creditcard.value)) {
                                    window.alert("Valid credit card");
                                } else {
                                    window.alert("Invalid Credit Card number");
                                    return false;
                                }

                                if (cvv.value === "")
                                {
                                    window.alert("CVV is empty");
                                    return false;
                                } else if (regexcvv.test(cvv.value)) {
                                    window.alert("Valid cvv");
                                } else {
                                    window.alert("Invalid CVV");
                                    return false;
                                }
//                            else
//                            {
//                            alert("Booking is sucessful ! ");
//                            }
                            }
                            //---------------------------Calculate price-----------------------------------------
                            function GetDays() {
                                var dropdt = new Date(document.getElementById("checkout").value);
                                var pickdt = new Date(document.getElementById("checkin").value);
                                return parseInt((dropdt - pickdt) / (24 * 3600 * 1000));
                            }
                            function price()
                            {
                                var dropdt = new Date(document.getElementById("checkout").value);
                                var pickdt = new Date(document.getElementById("checkin").value);
                                var price = 1000;
                                return parseInt(price * (dropdt - pickdt) / (24 * 3600 * 1000));
                            }
                            function cal() {
                                if (document.getElementById("checkin")) {
                                    document.getElementById("numdays").value = GetDays();
                                    document.getElementById("total").value = price();
                                }
                            }
                        </script>
                    </div>
                </div> 
            </div> 
        </div>
        <!---- end of  rooms--->
        <hr>
        <!--amenities container-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12"> 
                    <h1><small>Amenities</small></h1>
                    <span class="glyphicon glyphicon-bed"></span>2 bed
                    <span class="glyphicon glyphicon-user"></span>2 Guests
                    <span class="glyphicon glyphicon-cutlery"></span>Free Breakfast
                </div>
            </div>
        </div>
        <!--end of amenities container-->
        <hr>
        <!--around the hotel container-->
        <div class="container-fluid">                 
            <h1><small>Around the hotel</small></h1>
            <div class="row">                          
                <div class="col-sm-3">
                    <img src="img/events.jpeg" class="img-responsive" style="width:100%; " alt="Image">
                    <p>Events</p>
                </div>
                <div class="col-sm-3"> 
                    <img src="img/dining.jpg" class="img-responsive" style="width:100%" alt="Image">
                    <p>Dining</p>    
                </div>
                <div class="col-sm-3"> 
                    <img src="img/rest.jpeg" class="img-responsive" style="width:100%" alt="Image">
                    <p>Restaurants</p>    
                </div>
                <div class="col-sm-3"> 
                    <img src="img/bar.jpg" class="img-responsive" style="width:100%" alt="Image">
                    <p>Bar</p>    
                </div>                                                
            </div> 
        </div>
        <!--end of around the hotel container-->
        <hr>
        <!--comments container-->
        <div class="container-fluid">  
            <h1><small>What others say:</small></h1>
            <br>
            <p><span class="badge">2</span> Comments:</p><br>
            <div class="row">
                <div class="col-sm-2 text-center">
                    <span class="glyphicon glyphicon-user"></span>
                </div>
                <div class="col-sm-10">
                    <h4>Tom <small>Oct 2, 2019, 9:12 PM</small></h4>
                    <p> very clean and spacious!</p>
                    <br>
                </div>
                <div class="col-sm-2 text-center">
                    <span class="glyphicon glyphicon-user"></span>
                </div>
                <div class="col-sm-10">
                    <h4>Mary <small>Oct 5, 2019, 8:25 PM</small></h4>
                    <p>Service was excellent! will come again!</p>
                    <br>
                    <p><span class="badge">1</span> Comment:</p><br>
                    <div class="row">
                        <div class="col-sm-2 text-center">
                            <span class="glyphicon glyphicon-user"></span>
                        </div>
                        <div class="col-xs-10">
                            <h4>John <small>Sep 27, 2019, 8:28 PM</small></h4>
                            <p>Definitely.</p>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end of comments container-->

        <!--Footer-->
        <div id="footer-placeholder">
            <script>
                $(function () {
                    $("#footer-placeholder").load("footer.php");
                });
            </script>
        </div>
        <!--end of Footer-->
    </body>
</html>
