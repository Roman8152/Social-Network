<?php

session_start();

include_once 'additional_code/dbh.inc.php';

$find = mysqli_real_escape_string($conn, $_POST["getter"]);
$msg = mysqli_real_escape_string($conn, $_POST["msg"]);
$savedUid = $_SESSION['username'];
$findingErr = "";

if ($find != "" && isset($find)) {

    $sql = "SELECT 'user_uid' FROM users WHERE user_uid = '$find' ";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($msg != "") {
        if ($row > 0) {
            $sql = "INSERT INTO messages (msg, sender, getter) VALUES ('$msg', '$savedUid', '$find');";
            mysqli_query($conn, $sql);
            header("location: welcome.php");
            
        }

        else {
            $findingErr = "Wrong username, try again";
            header("location: welcome.php");    
        }

    }
    else {
        $findingErr = "No message written";
        header("location: welcome.php");
    }
}