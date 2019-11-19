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

    <!-- Third Party -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>

    <!-- Personal Style Sheet & Javascript -->
    <link href="css/main.css" rel="stylesheet" />
    <link href="css/registration.css" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script defer src="js/main.js"></script>

</head>

<body>

    <header>
        <?php
        include "./navbaruser.php";
        ?>
    </header>

    <section>
        <div class="jumbotron text-center bg-light">
            <h2>Your account has been successfully registered</h2>
            <p>Click here to <a href="./login.php">sign in</a></p>
        </div>

        <img src="img/bookroom1.jpg" class="mx-auto d-block img-fluid shrinkImageFam" alt="background">
        <figcaption>Photo from Pixabay.com</figcaption>
    </section>

    <?php
    include "./footer.php";
    ?>

</body>

</html>