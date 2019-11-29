<!doctype html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en-US">

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
        <?php

        // Constants for accessing our DB:
        define("DBHOST", "161.117.122.252");
        define("DBNAME", "p1_4");
        define("DBUSER", "p1_4");
        define("DBPASS", "5xLMQfLGsc");
        $errorMsg = $pass =  "";
        $email = sanitize_input($_POST["email"]);
        $success = true;
            
       function generateRandomString($length = 15) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

        function sanitize_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if (empty($_POST["email"])) {
            $errorMsg .= "Email is required.<br>";
            $success = false;
        } else {
            $email = sanitize_input($_POST["email"]);
            //To check if the email address is well formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errorMsg .= "Invalid email format.";
                $success = false;
            } else {
                //Create connection
                $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

                //Check connection
                if ($conn->connect_error) {
                    $errorMsg = "Connection failed: " . $conn->connect_error;
                    $success = false;
                } else {
                    $sql = "SELECT * FROM users WHERE ";
                    $sql .= "email = '$email'";
                    
                    //Execute the query
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        //Note that email field is unique, so should only have
                        //one row in the result set.
                        $row = $result->fetch_assoc();
                        $email = $row["email"];
                        $pass = md5($row["password"]);
                        
                        $code=generateRandomString();
                        
                        $to = $email;
                        $subject = "Your Recovered Password";
                        $message = "Please use this password to login " . $code;
                        $headers =  'MIME-Version: 1.0' . "\r\n";
                        $headers .= 'From: Hotel Booking <hotelbooking@mail.com>' . "\r\n";
                        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                       $mml = mail($to, $subject, $message, $headers);

                        if($mml){
                        mysqli_query($conn,"UPDATE users SET password='".md5($code)."' where email='".$_POST['email']."'");

                                    echo '<div class="alert alert-success">
                                              <strong>New Password Has Been Sent to Your Mail!</strong> Check Your Inbox.
                                            </div>';} else {
                        echo '<div class="alert alert-warning">
                                              <strong>Timeout, Try again later!</strong>.
                                            </div>';
                        }


                        //        echo"<h2>Login Successfully</h2>";
                        //        echo"<p>Welcome Back,$fname <br>" ;
                        //
                        //        echo"<form action ='index.php'>";
                        //        echo "<input type='submit' value='Return to home'>";
                        //        echo"</form>";
                    } else {
                        $success = false;
                        $errorMsg .= "Your email does not exist.";
                    }
                    $result->free_result();
                }
                $conn->close();
            }
        }
        ?>


        <div class="container">
            <?php
            //checks if login session variable exist? If it does, display logout
            if ($success == true) {
                echo "<p>We will send you an email shortly to $email</p>";
                echo "<form action ='index.php'>";
                echo "<input type='submit' value='Return to home'>";
                echo "</form>";
            } else {
                echo "<h2>Oops!</h2>";
                echo "<h3>The following errors were detected: </h3>";
                echo "<p>$errorMsg</p>";
            }
            ?>
        </div>
    </main>

    <?php
    include "./footer.php";
    ?>
</body>

</html>

