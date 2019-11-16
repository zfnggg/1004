<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <title>Check Login</title>
    </head>

    <body>

        <?php
        session_start();
        define("DBHOST", "161.117.122.252");
        define("DBNAME", "p1_4");
        define("DBUSER", "p1_4");
        define("DBPASS", "5xLMQfLGsc");

        $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
        if (isset($_POST["submit"])) {
            $u = $_POST['username'];
            $p = $_POST['password'];
            $u = mysqli_real_escape_string($conn, $u);
            $p = mysqli_real_escape_string($conn, $p);
            $p = md5($p);

            

            $sql = $conn->prepare("SELECT * FROM users WHERE username = ? and password= ? ");
            $sql->bind_param("ss", $u, $p);
            $sql->execute();
            $search_result = $sql->get_result();

//        $search_result = mysqli_query($conn, $sql);
            $userfound = mysqli_fetch_assoc($search_result);

            if ($userfound >= 1) {
                $sql = $conn->prepare("SELECT * FROM users WHERE username = '$u' ");
                $sql->bind_param("s", $u);
                $sql->execute();
                $search_result = $sql->get_result();
                //$search_result = mysqli_query($conn, $sql);
                $one_record = mysqli_fetch_assoc($search_result);
                $r = $one_record['role'];
                $_SESSION['MM_Username'] = $u;
                $_SESSION['MM_role'] = $r;
                header("Location:reservation.php");
            } else {
                echo "<h1>Username not found or password doesn't match...<h1>";
                echo("<button onclick=\"location.href='login.php'\">Login</button>");
            }

            $sql->close();
            mysqli_close($conn);
        }
        ?>
    </body>

</html>

