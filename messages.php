<?php

include_once 'additional_code/dbh.inc.php';

session_start();

$sql = "SELECT * FROM messages WHERE sender = 'SneakPeak' OR getter = 'SneakPeak' ORDER BY id ASC LIMIT 20";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
    echo "it works";

    while($row = mysqli_fetch_assoc($result)) {
        echo htmlspecialchars($row["sender"] . ": " . $row["msg"]);
        echo "<br><br>";
    }
}
else {
    echo "It doesn't work";
}



?>