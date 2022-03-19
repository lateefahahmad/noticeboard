<?php

echo <<<_END
<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
_END;
require("templates/head.php");
require("templates/header.php");
echo "<body id='background'>";

require_once "credentials.php";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if(!$connection) {
    die("Connection failed".$mysqli_connect_error);
}

//*INDICATE AN ANNON USER LINK ALLOWING THEM TO CREATE POSTS*
if(isset($_POST["username"]) != NULL && isset($_POST["password"]) != NULL) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users";
    $result = mysqli_query($connection, $query);

    foreach($result as $row) {
        if($row["username"] == $username && $row["password"] == $password) {
            $loggedIn = true;
            $_SESSION["loggedIn"] = true;
            $_SESSION["username"] = $username;
            $_SESSION["firstname"] = $row["firstname"];
            $_SESSION["uid"] = $row["uid"];
            header("location: index.php");
            break;
        }
     }
} elseif (isset($_SESSION["loggedIn"]) != NULL && isset($_SESSION["username"]) != NULL) {
    $loggedIn = $_SESSION["loggedIn"];
    $username = $_SESSION["username"];
}


if ($loggedIn == false) {

    echo <<<_END
        <h3>Sign In</h3>
        <form action="signin.php" class="col-2" method="POST">
        <label for="name-box">Username</label><br>
        <input class="form-control" minlength="3" maxlength="32" id="name-box" name="username" type="text"><br>
        <label for="password-box">Password</label><br>
        <input class="form-control" minlength="3" maxlength="64" id="pasword-box" name="password" type="password"><br><br>
        <button class="btn btn-info">Login</button>
        </form>
    
    _END;
    
} elseif ($loggedIn == true) {
    echo <<<_END
    <h3> Welcome, {$username} </h3>
    _END;
}  

require "templates/footer.php";
echo <<<_END
</body>
</html>
_END;
?>