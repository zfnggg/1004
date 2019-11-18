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
        Response.AddHeader("X-Frame-Options", "DENY");
    
        ?>
    </header>


    <section class="jumbotron text-center bg-light">
        <header>
            <h2>DESTINATION: D'HOTEL</h2>
        </header>
    </section>

    <figure>
        <img src="img/family.jpg" class="mx-auto d-block img-fluid shrinkImageFam" alt="bg1">
        <figcaption>Photo from Pixabay.com</figcaption>
    </figure>

    <section>
        <div class="bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-sm-1"> </div> <!--  First Column -->
                    <div class="col-sm-10">
                        <div class="text-center textPadTop">
                            <h4>Make D’Hotel your go-to destination for fun & relaxation! At Singapore’s first nature-inspired hotel with a Michelin Star restaurant, you can get away from the hustle and bustle of the city and enjoy quality time with your loved ones</h4>
                        </div>
                    </div>
                    <div class="col-sm-1"></div>

                    <div class="col-sm-2"></div> <!-- NEXT COLUMN -->
                    <div class="col-sm-4 text-center">
                        <figure>
                            <img src="img/restaurant1.jpg" class="shrinkImageAbout" alt="rest1">
                            <figcaption>Photo from Pixabay.com</figcaption>
                        </figure>
                        <div><i class="fas fa-cocktail iconGrow"></i></div>
                        <div class="textPadTop">
                            <h5>Relax and enjoy tasty delicacies at our Michelin Star restaurant. Bring your loved ones to enjoy our plethora of mouth-watering entrées, main courses, and topping it off with our home-made desserts</h5>
                        </div>
                    </div>

                    <div class="col-sm-4 text-center">
                        <figure>
                            <img src="img/towel.jpg" class="shrinkImageAbout" alt="towel">
                            <figcaption>Photo from Pixabay.com</figcaption>
                        </figure>
                        <div><i class="fas fa-swimmer iconGrow"></i></div>
                        <div class="textPadTop">
                            <h5>Comfort at your doorstep. Our facilities include a Thai-style massage parlor, an indoor badminton court, an outdoor swimming pool and so much more! You'll never have a moment of boredom here!</h5>
                        </div>
                    </div>
                    <div class="col-sm-2"> </div>

                </div>
            </div>
        </div>
    </section>

    <?php
    include "./footer.php";
    ?>
</body>

</html>