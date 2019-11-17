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

<?php

require_once('../protected/config.php');
$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

$query = "SELECT * FROM booking";
$result = mysqli_query($conn, $query);
$chart_data = '';
while ($row = mysqli_fetch_array($result)) {
    $chart_data .= "{ year:'" . $row["checkin"] . "', total:" . $row["total"] . ",}, ";
}
$chart_data = substr($chart_data, 0, -2);
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
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
</head>

<body>
    

    <div class="jumbotron text-center">
        <h1>Admin Page</h1>
    </div>

    <div class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-2 sidenav">
            </div>
            <div class="col-sm-8 text-left">
                <br /> <a href="customerprofile.php" title="manage">Customer Profile</a>
                <br /> <a href="booking.php" title="manage">Booking</a>
                <br /> <a href="bookingsummary.php" title="manage">Booking Summary</a>
            </div>
            <div class="col-sm-2 sidenav">
            </div>
        </div>
    </div>

    <div class="container" style="width:900px;">
        <h3 class="centeralign">Revenue</h3>
        <br /><br />
        <div id="chart"></div>
    </div>

    <script>
        Morris.Bar({
            element: 'chart',
            data: [<?php echo $chart_data; ?>],
            xkey: 'year',
            ykeys: ['total'],
            labels: ['total'],
            hideHover: 'auto',
            stacked: true
        });

    </script>

    <?php
            include "./footer.php";
            ?>

    </html>
</body>

</html>
