<?php

include_once "additional_code/dbh.inc.php";

session_start();

if (isset($_SESSION["username"]) && isset($_SESSION["password"])) {
    header("location: welcome.php");
    exit;
}
else {

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $loginUsername = trim(mysqli_real_escape_string($conn, $_POST["login_uid"]));
        $loginPass = trim(mysqli_real_escape_string($conn, $_POST["login_pwd"]));
        $loginUidError = "";
        $loginPassError = "";
        $username = "user_uid";
        $password = "user_pwd";

        $sql = "SELECT $username, $password FROM users WHERE user_uid = '$loginUsername' ";

        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        if ($row > 0) {

            if ($loginUsername == $row[$username] && $loginPass == password_verify($loginPass ,$row[$password])) {
                $_SESSION["username"] = $loginUsername;

                if($_POST["remember_me"]=='1' || $_POST["remember_me"]=='on' || !empty($_POST["remember_me"])) {
                    $_SESSION["password"] = $loginPass;
                    header("location: welcome.php");
                    exit;
                }
            header("location: welcome.php");
            exit;
            }
            elseif ($loginPass !== $row[$password]){
                $loginPassError = "Wrong Password";
            }
            
        }
        else {
            $loginUidError = "Wrong Username";
        }
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Log in</title>
        <link rel="stylesheet" type="text/css" href="additional_code/style.css">
    </head>
    <body>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input class="btn" type="text" name="login_uid" placeholder="Username">
            <p>
                <?php 
                if (!empty($loginUidError)) { 
                    echo $loginUidError; 
                }                       
                ?>
            </p>
            <br>
            <input class="btn" type="password" name="login_pwd" placeholder="Password">
            <p>
                <?php
                if (!empty($loginPassError)) {
                    echo $loginPassError;    
                }
                ?>
            </p>
            <br>
            <div id="rmmbr">
                <input type="checkbox" name="remember_me" id="rmmbr_me">
                <label for="rmmbr_me">Remember me</label>
            </div>
            
            <button class="btn" id="submit" type="submit">Log in</button>
        </form>
        <div>
            <a href="register.php">Don't have an account?</a>
        </div>
    </body>
</html>