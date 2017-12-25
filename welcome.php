<?php

include_once "additional_code/dbh.inc.php";

session_start();

$savedUsername = $_SESSION["username"];

if (!isset($savedUsername) || empty($savedUsername)) {
    header("location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="manage.js"></script>
        <title>FaceSnapInstaTwitSpace</title>
        <link rel="stylesheet" type="text/css" href="additional_code/welcome.css">
    </head>
    <body>
        <p>Hi, <b><?php echo $_SESSION["username"] ?></b>. Welcome to Social Network 0.2!</p>
        <div>
            <a href="logout.php">Sign out</a>
        </div>
        <div>
            <div id="getMsg"></div>
        </div>
        <br>
        <br>
        <form action="msg_write.php" method="POST">
            <input type="text" name="getter" placeholder="To who ?">
            <input type="text" name="msg" placeholder="Message">
            <input type="submit" value="Send">
        </form>
    </body>
</html>