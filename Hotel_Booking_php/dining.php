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
        <!-- Title for Dining-->
        <div class="container-fluid">
            <div class="row">
                <header class="col ">
                    <div class="article">
                        <h3 class="display-4 text-center">Dining</h3>
                    </div>
                </header>
            </div>
        </div>
        
        <div class="container-fluid">
            <div class="row">
                <figure class="col-md-6 col-sm-12">
                    <img src="./img/breakfast.jpg" class="float-left bf-margin" alt="A breakfast dish from Po">
                    <figcaption>Photo from Pixabay.com</figcaption>
                </figure>
                <header class="col-md-6 col-sm-12">
                    <div class="description text-center bf-desc-margin">
                        <h1 class="display-4 text">Breakfast w/ Po</h1>
                        <hr>
                        <p>Start your day right with our extensive breakfast menu
                            to fuel your body for the rest of your day.
                            The hotel’s breakfast collaborator, Po, is a refined modern Singaporean
                            concept presenting an array of local classics and elevated Singaporean
                            staples. Po seeks to bridge the gap between our nation’s vibrant culinary
                            heritage and our rich collective memories of home cooked specialties.</p>
                        <a href='https://www.po.com.sg' rel="noopener noreferrer" target="_blank" class="btn btn-outline-dark btn-visit">Visit Site</a><span><a href='https://www.po.com.sg/menu' rel="noopener noreferrer" target="_blank" class="btn btn-outline-dark">View Menu</a></span>
                    </div>
                </header>
            </div>
        </div>
        
        <div class="container-fluid">
            <div class="row">
                <figure class="col-md-6 col-sm-12 order-md-2">
                    <img src="./img/lunch.jpg" class="lunch-margin" alt="A burger from 25 Degrees">
                    <figcaption>Photo from Pixabay.com</figcaption>
                </figure>
                <header class="col-md-6 col-sm-12 order-md-1">
                    <div class="description text-center lunch-desc-margin">
                        <h1 class="display-4 text">Lunch w/ 25 Degrees</h1>
                        <hr>
                        <p>Originated in Los Angeles, with a branch in Bangkok,
                            this burger & liquor bar is named after the precise temperature difference between a
                            raw and well done hamburger, 25 Degrees introduces a sophisticated new twist on the
                            traditional American burger bar concept –complete with funky music and cool “bordello
                            meets burger bar” décor.</p>
                        <a href='https://www.randblab.com/25degrees-sg' rel="noopener noreferrer" target="_blank" class="btn btn-outline-dark btn-visit">Visit Site</a><span><a href='https://www.randblab.com/assets/menu/25%20DEGREES%20SINGAPORE/25Degrees-19-aug.pdf' rel="noopener noreferrer" target="_blank" class="btn btn-outline-dark">View Menu</a></span>
                    </div>

                </header>
            </div>
        </div>
        
        <div class="container-fluid">
            <div class="row">
                <figure class="col-md-6 col-sm-12">
                    <img src="./img/dinner.jpg" class="float-left bf-margin" alt="Inside of Ginett restaurant">
                    <figcaption>Photo from Pixabay.com</figcaption>
                </figure>
                <header class="col-md-6 col-sm-12">
                    <div class="description text-center bf-desc-margin">
                        <h1 class="display-4 text">Dinner w/ Ginett</h1>
                        <hr>
                        <p>Ginett wine bar & restaurant is located on the Ground floor.
                            With a culinary team led by our highly acclaimed Executive Chef, the restaurant
                            offers imported cold cuts and cheese, premium wines and daily specials cooked
                            with quality ingredients. The venue features a cozy communal space, perfect
                            for mingling. Open for breakfast, lunch and dinner.</p>                        
                        <a href='https://www.randblab.com/ginett-sg' rel="noopener noreferrer" target="_blank" class="btn btn-outline-dark btn-visit">Visit Site</a><span><a href='https://www.randblab.com/assets/menu/GINETT/Ginett-SG-FULL-MENU-22AUG.pdf' rel="noopener noreferrer" target="_blank" class="btn btn-outline-dark">View Menu</a></span>
                    </div>
                </header>
            </div>
        </div>
    <?php
    include "./footer.php";
    ?>
    </body>
</html>
