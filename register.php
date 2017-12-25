<?php

include_once "additional_code/dbh.inc.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $first = trim(mysqli_real_escape_string($conn, $_POST["first"]));
    $last = trim(mysqli_real_escape_string($conn, $_POST["last"]));
    $email = trim(mysqli_real_escape_string($conn, $_POST["email"]));
    $uid = trim(mysqli_real_escape_string($conn, $_POST["uid"]));
    $pwd = trim(mysqli_real_escape_string($conn, $_POST["pwd"]));

    $sql = "SELECT user_uid, user_email FROM users";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if (empty($first) || empty($last) || empty($email) || empty($uid) || empty($pwd)) {
        echo "Oops... Looks like something is missing";
    }
    elseif (!empty($first) && !empty($last) && !empty($email) && !empty($uid) && !empty($pwd))
    if ($email == $row["user_email"]) {
        echo "This email is already bind to an account";
    }
    elseif ($email !== $row["user_email"]) {

        if ($uid == $row["user_uid"]) {
            echo "This username is already taken";
        }
        elseif ($uid !== $row["user_uid"]) {
            $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd)
            VALUES ('$first', '$last', '$email', '$uid', '$hashedPwd');";
            mysqli_query($conn, $sql);
            
        }
    } 
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" type="text/css" href="additional_code/style.css">
    </head>
    <body>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input class="input" type="text" name="first" placeholder="First Name">
            <br>
            <input class="input" type="text" name="last" placeholder="Last Name">
            <br>
            <input class="input" type="email" name="email" placeholder="E-Mail">
            <br>
            <input class="input" type="text" name="uid" placeholder="Username">
            <br>
            <input class="input" type="password" name="pwd" placeholder="Password">
            <br>
            <button id="submit" type="submit">Sign up</button>
        </form>
        <div>
            <a href="login.php">Do you already have an account?</a> 
        </div>    
    </body>
</html>