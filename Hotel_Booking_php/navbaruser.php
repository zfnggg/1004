<?php
//if (!isset($_SERVER['HTTP_REFERER'])) {
// redirect them to your desired location
// header('location:login.php');

// exit;
//}
?>
<?php
session_start();

//Browser refuses to display requested document in a frame, in case that origin does not match
header("X-Frame-Options: sameorigin");

//Enables the XSS Filter. Rather than sanitize the page, when a XSS attack is detected
//The browser will prevent rendering of the page.
header("X-XSS-Protection: 1; mode=block");

//The referrer is always sent, but contain only the origin if a request is cross-origin. Otherwise, the full URL is sent.
header("Referrer-Policy: origin-when-cross-origin");

//Enable and disable specific browser features and APIs
header("Feature-Policy: camera 'none'; fullscreen 'self'; geolocation *; microphone 'self'");

//Prevents attacks based on MIME-type mismatch
header("X-Content-Type-Options: nosniff");
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand"><img src="img/icon.png" id="icon" alt=""></a>
        <a class="navbar-brand" id="titleHead" href="#">D'Hotel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="./index.php">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./about.php">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./rooms.php">Rooms</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./dining.php">Dining<span class="caret"></span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" data-target="dropdown_target" href="#">Contact</a>
                    <ul class="dropdown-menu">
                        <a class="dropdown-item" href="./faq.php">FAQ</a>
                        <a class="dropdown-item" href="./events.php">Events</a>
                    </ul>
                </li>

                <?php

                if (isset($_SESSION['MM_Username'])) { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" data-target="dropdown_target" href="#">Account</a>
                        <ul class="dropdown-menu">
                            <a class="dropdown-item" href="./editmyprofile.php">Edit Profile</a>
                            <a class="dropdown-item" href="./reservation.php">My Reservation</a>
                            <a class="dropdown-item" href="./logout.php">Log out</a>
                        </ul>
                    </li>
                    
                    <?php
                        
                        $inactive = 900;

                        if (isset($_SESSION['timeout'])) {
                            $session_life = time() - $_SESSION['timeout'];
                            if ($session_life > $inactive) {
                                $_SESSION['logout'] = "1";
                                header("Location: ./logout.php");
                            }
                        }

                        $_SESSION['timeout'] = time();
                    ?>

                <?php
                } else {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="./login.php">Login</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>