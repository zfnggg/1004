<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php

include "./navbaruser.php";

?>
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

        <div class="container-fluid">
            <div class="row">
                <header class="col">
                    <div class="article">
                        <h3 class="display-4 text-center">FAQs</h3>
                    </div>
                </header>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col align-items-center">
                    <table class="table table-info table-hover faq-border">
                        <thead>
                            <tr>
                                <th class="faq-text">What are the check-in & check-out times?</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="faq-text">Our check in time is 2.00pm & check out time is 12 noon.</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-info table-hover faq-space">
                        <thead>
                            <tr>
                                <th class="faq-text">Can I request for a late check-out or early check-in?</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="faq-text">Certainly. Late check-out & early check-in requests are subject to availability. Please call or enquire with the front desk the day you arrive / depart to see if there is availability.</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-info table-hover faq-space">
                        <thead>
                            <tr>
                                <th class="faq-text">Is smoking allowed in the rooms?</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="faq-text">Our hotel is a non-smoking property thus smoking is strictly not allowed in our rooms. Anyone caught smoking in a room will be charged a SGD 250 cleanup fee. Please approach our front desk to check on the location of the designated smoking areas in the vicinity of the building.</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-info table-hover faq-space">
                        <thead>
                            <tr>
                                <th class="faq-text">Is there free WiFi available?</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="faq-text">Yes, complimentary high-speed internet / WIFI access is available throughout the hotel; in all guestrooms & public spaces. One can sign in on multiple devices with no password required.</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-info table-hover faq-space">
                        <thead>
                            <tr>
                                <th class="faq-text">Do you allow dogs/pets?</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="faq-text">We love dogs & pets but unfortunately, we do not allow them at the hotel. Certified Guide Dogs are however permitted.</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-info table-hover faq-space">
                        <thead>
                            <tr>
                                <th class="faq-text">Is there parking space in the hotel?</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="faq-text">Yes, we do have limited parking spaces for our guests, however, they are on a first-come first-serve basis.</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-info table-hover faq-space">
                        <thead>
                            <tr>
                                <th class="faq-text">Do you have wheelchair accessible rooms?</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="faq-text">Yes, we do have one wheelchair accessible room on the first floor of the hotel. Prior arrangement needs to be made to check for availability.</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-info table-hover faq-space">
                        <thead>
                            <tr>
                                <th class="faq-text">Does your hotel provide baby cribs?</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="faq-text">We have cribs for children up to 4 years old. The crib size is 24″ x 38.” Please let us know if you would like to reserve as they are subject to availability.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
        <?php
    include "./footer.php";
    ?>
</html>

