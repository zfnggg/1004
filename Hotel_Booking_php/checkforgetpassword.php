<!doctype html>

<?php
include "./navbaruser.php";
?>

<html lang="en-US">
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

<head>
    <meta charset="utf-8">
    <title>Check Login</title>
</head>



<?php

// Constants for accessing our DB: 
define("DBHOST", "161.117.122.252");
define("DBNAME", "p1_4");
define("DBUSER", "p1_4");
define("DBPASS", "5xLMQfLGsc"); 
$email = $errorMsg = "";
$success = true;


if(empty($_POST["email"]))
{
    $errorMsg .= "Email is required.<br>";
    $success = false;
}
else
{
    $email = sanitize_input($_POST["email"]);
    //To check if the email address is well formed 
    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $errorMsg .= "Invalid email format.";
        $success = false;
    }
}
function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//Create connection
$conn = new mysqli(DBHOST,DBUSER,DBPASS,DBNAME);

//Check connection 
if($conn->connect_error)
{
    $errorMsg = "Connection failed: " .$conn->connect_error;
    $success = false;
}
else
{
    $sql = "SELECT * FROM users WHERE ";
    $sql .= "email = '$email'"; 
    
    //Execute the query 
    $result = $conn->query($sql);
    if($result->num_rows > 0)
    {
        //Note that email field is unique, so should only have 
        //one row in the result set. 
        $row = $result->fetch_assoc();
        $email=$row["email"];
       
        $_SESSION['email'] =$email;
     
//        echo"<h2>Login Successfully</h2>";
//        echo"<p>Welcome Back,$fname <br>" ;
//        
//        echo"<form action ='index.php'>";
//        echo "<input type='submit' value='Return to home'>";
//        echo"</form>";
    }
else
{
    echo "<h2>Opps!</h2>";
    echo "<h4>The following input errors were detected:</h4>";
    echo "<p>". $errorMsg ."</p>";
}
    $result->free_result();
}
$conn->close();
?>
<body>
  <div class="container">
<p><?php
         
            //checks if login session variable exist? If it does, display logout
		if (isset($_SESSION['email'])!= "")
		{
                       echo"<p>We will send you an email shortly to $email</p>";
        
                        echo"<form action ='index.php'>";
                        echo "<input type='submit' value='Return to home'>";
                        echo"</form>";
		}
		else
		{
                  
                         $errorMsg = "Email not found or password doesn't match....";
                     echo"<h2>Oops!</h2>";
                    echo"<h3>The following errors were detected: </h3>";
                     echo"<p>$errorMsg</p>" ;
                        $success = false;
                    
                     
                    
                  
		}
		?></p>
 </div>
</body>

   <?php
        include "./footer.php";
        ?>

</html>