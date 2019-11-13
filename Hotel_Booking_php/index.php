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
        <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>-->
        <link href="css/main.css" rel="stylesheet" />
        <!-- Own CSS Style Sheet-->
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
        <!-- Font Awesome Icons -->
        <script defer src="js/main.js"></script>
        <!-- Own Javascript -->
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

        <header>
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <!-- Slide One - Set the background image for this slide in the line below -->
                    <div class="carousel-item active" style="background-image: url('img/hotel1.jpg')">
                        <div class="carousel-caption d-none d-md-block">
                            <h2 class="display-4">A Luxurious Stay</h2>
                            <p class="lead">Quality Assured</p>
                        </div>
                    </div>
                    <!-- Slide Two - Set the background image for this slide in the line below -->
                    <div class="carousel-item" style="background-image: url('img/hotel2.jpg')">
                        <div class="carousel-caption d-none d-md-block">
                            <h2 class="display-4">Defining Moments</h2>
                            <p class="lead">Precious memories to be made</p>
                        </div>
                    </div>
                    <!-- Slide Three - Set the background image for this slide in the line below -->
                    <div class="carousel-item" style="background-image: url('img/hotel3.jpg')">
                        <div class="carousel-caption d-none d-md-block">
                            <h2 class="display-4">Dream in Reality</h2>
                            <p class="lead">Fulfill your fantasies</p>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </header>

        <section class="services bg-light">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-md-4 ftco-animate py-5 nav-link-wrap aside-stretch">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist">
                            <a class="nav-link px-4 imgLink bg-light" id="v-pills-room-tab" data-toggle="pill" href="#v-pills-room" role="tab" aria-controls="v-pills-room" aria-selected="true"><i class="fas fa-bed"></i> Rooms</a>
                            <a class="nav-link px-4 imgLink bg-light" id="v-pills-event-tab" data-toggle="pill" href="#v-pills-event" role="tab" aria-controls="v-pills-event" aria-selected="false"><i class="fab fa-dribbble"></i> Events</a>
                            <a class="nav-link px-4 imgLink bg-light" id="v-pills-dining-tab" data-toggle="pill" href="#v-pills-dining" role="tab" aria-controls="v-pills-dining" aria-selected="false"><i class="fas fa-cocktail"></i> Dining</a>
                            <a class="nav-link px-4 imgLink bg-light" id="v-pills-policy-tab" data-toggle="pill" href="#v-pills-policy" role="tab" aria-controls="v-pills-policy" aria-selected="false"><i class="fas fa-feather-alt"></i> Policy</a>
                        </div>
                    </div>

                    <div class="col-md-8 ftco-animate p-4 p-md-5 d-flex align-items-center">
                        <div class="tab-content pl-md-5" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-room" role="tabpanel" aria-labelledby="v-pills-room-tab">
                                <span class="icon mb-3 d-block flaticon-bed"></span>
                                <h2 class="mb-4">Bedrooms</h2>
                                <p>With an array of astounding bedrooms,ranging from single rooms to a presidential suite, we ensure maximum comfort and and 100% customer satisfaction</p>
                                <!-- can put class="lead" if want bigger -->
                                <div class="justify-content-center">
                                    <a id="A1">
                                        <img src="img/bedroom1.jpg" class="shrinkImageThumbnail" alt=""/>
                                        <span id="pop1" class="popup">
                                            <img src="img/bedroom1.jpg" class="shrinkImageBig"/>
                                        </span>
                                    </a>
                                    <a id="A2">
                                        <img src="img/bedroom2.jpg" class="shrinkImageThumbnail" alt=""/>
                                        <span id="pop2" class="popup">
                                            <img src="img/bedroom2.jpg" class="shrinkImageBig"/>
                                        </span>
                                    </a>
                                    <a id="A3">
                                        <img src="img/bedroom3.jpg" class="shrinkImageThumbnail" alt="" />
                                        <span id="pop3" class="popup">
                                            <img src="img/bedroom3.jpg" class="shrinkImageBig"/>
                                        </span>
                                    </a>
                                    <a id="A4">
                                        <img src="img/bedroom4.jpg" class="shrinkImageThumbnail" alt="" />
                                        <span id="pop4" class="popup">
                                            <img src="img/bedroom4.jpg" class="shrinkImageBig"/>
                                        </span>
                                    </a>
                                </div>
                                <!--<p><a href="#" class="btn btn-primary">Learn More</a></p>-->
                            </div>

                            <div class="tab-pane fade" id="v-pills-event" role="tabpanel" aria-labelledby="v-pills-event-tab">
                                <span class="icon mb-3 d-block flaticon-tray"></span>
                                <h2 class="mb-4">Events</h2>
                                <p>Be it a birthday, anniversary or romantic celebration, make your staycation one to remember with D'Hotel!</p>
                                <p><a href="events.php" class="btn btn-dark">Learn More</a></p>
                            </div>

                            <div class="tab-pane fade" id="v-pills-dining" role="tabpanel" aria-labelledby="v-pills-dining-tab">
                                <span class="icon mb-3 d-block flaticon-woman"></span>
                                <h2 class="mb-4">Dining</h2>
                                <p>Here at D'Hotel, we strive to provide our customers with quality food at an affordable price – freshly prepared and fast everytime! Without compromising our service standards, we hope you will enjoy yourself in our own unique ambience and be spoilt in a great variety of food choices </p>
                                <p><a href="dining.php" class="btn btn-dark">Learn More</a></p>
                            </div>

                            <div class="tab-pane fade" id="v-pills-policy" role="tabpanel" aria-labelledby="v-pills-policy-tab">
                                <span class="icon mb-3 d-block flaticon-tray"></span>
                                <h2 class="mb-4">Our Policy</h2>
                                <p class="lead">Here at D'Resort, we aim to provide 100% customer satisfaction through quality communication and services</p>
                                <h5 class="line">Customer Reviews</h5>
                                <p>Hands down one of the best experiences my wife and I had during our anniversary</p>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <p class="text2">By Chef Bob, Renowned Culinary Chef</p>
                                <hr>
                                <p>Quality rooms and top-notch customer service</p>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <p class="text2">By Lilian Wong, Trivago Hotel Manager</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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