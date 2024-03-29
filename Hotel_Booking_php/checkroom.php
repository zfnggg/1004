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
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>-->
    <link href="css/main.css" rel="stylesheet" />
    <!-- Own CSS Style Sheet-->
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <!-- Font Awesome Icons -->
    <script defer src="js/main.js"></script>
    <!-- Own Javascript -->
</head>

<body>

    <header>
        <?php
        include "./navbaruser.php";
        ?>
    </header>

    <main>
        <section class="jumbotron text-center bg-light">
            <h2>ENJOY YOUR STAY WITH US NOW</h2>
        </section>

        <figure>
            <img src="img/bookroom1.jpg" class="mx-auto d-block img-fluid shrinkImageFam" alt="">
            <figcaption>Photo from Pixabay.com</figcaption>
        </figure>

        <section>
            <!-- Booking Form -->
            <form action="./availablerooms.php" method="post" name="checkroom">
                <div class="bg-light">
                    <div class="container bg-padding">
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group text-center">
                                            <label for="checkin">Check-In Date</label>
                                            <input name="checkin" type="date" id="checkin" class="form-control" required />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group text-center">
                                            <label for="checkout">Checkout Date</label>
                                            <input name="checkout" type="date" id="checkout" class="form-control" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-1"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4">
                                <div class="col-md-10 bg-padding row-fluid">
                                    <button type="submit" name="submit" class="btn btn-primary btn-block ">Check Now</button>
                                </div>
                            </div>
                            <div class="col-sm-4"></div>
                        </div>
                        <div class="row"></div>
                    </div>
                </div>
            </form>
        </section>
    </main>

    <?php
    include "./footer.php";
    ?>

</body>

</html>