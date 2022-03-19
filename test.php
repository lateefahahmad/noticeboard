<?php
require_once "connection.php";

$query = "SELECT * FROM users";
$result = mysqli_query($connection, $query);

foreach($result as $row) {
    echo $row["uid"];
}
?>
