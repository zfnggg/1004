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
    </header>
    
    <main>

        <section class="container-fluid">
            <div class="row">
                <header class="col">
                    <div class="article">
                        <h3 class="display-4 text-center">Events</h3>
                    </div>
                </header>
            </div>
        </section>

        <section class="eventroom-image">
            <div class="eventroom-text">
                <h1>The Foyer</h1>
                <p>No strangers to hospitality, you can count
                    on the D' Hotel team to assist in planning and delivering
                    exceptional experiences for you and your guests.</p>
                <p><em>Full buyouts available upon request.</em></p>
            </div>
        </section>
        <p>Photo from Pixabay.com</p>

        <section class="ballroom-image">
            <div class="ballroom-text">
                <h1>The Hall</h1>
                <p>Exquisite interior space designed to better suit
                    your special day. Perfect for Weddings, Dance-and-Dinners, Ceremonies.
                </p>
                <p><em>"The perfect day calls for the perfect room."</em></p>
            </div>
        </section>
        <p>Photo from Pixabay.com</p>

        <?php
        include "./footer.php";
        ?>
    </main>
</body>

</html>