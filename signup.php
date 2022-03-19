<?php

require_once "credentials.php";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if(!$connection) {
    die("Connection failed".$mysqli_connect_error);
}


function prepare($string){
    return "'" . $string . "'";
}

if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true) {
    echo "Your already logged in";

} elseif(isset($_POST["username"]) &&
    isset($_POST["password"]) &&
    isset($_POST["firstname"]) && 
    isset($_POST["lastname"])  &&
    isset($_POST["email"]) &&
    isset($_POST["age"]) &&
    isset($_POST["city"]) &&
    isset($_POST["county"]) &&
    isset($_POST["country"]) &&
    isset($_POST["phone"])) { 

    // insert into database
    $usernameRecieved = prepare($_POST["username"]);
    $passwordRecieved = prepare($_POST["password"]);
    $firstnameRecieved = prepare($_POST["firstname"]);
    $lastnameRecieved = prepare($_POST["lastname"]);
    $emailRecieved = prepare($_POST["email"]);
    $ageRecieved = prepare($_POST["age"]);
    $cityRecieved = prepare($_POST["city"]);
    $countyRecieved = prepare($_POST["county"]);
    $countryRecieved = prepare($_POST["country"]);
    $phoneRecieved = prepare($_POST["phone"]);

    $query = "INSERT INTO users (username, password, firstname, lastname, email, age, city, county, country, phone)
    VALUES ($usernameRecieved,$passwordRecieved,$firstnameRecieved,$lastnameRecieved,$emailRecieved,$ageRecieved,$cityRecieved,$countyRecieved,$countryRecieved,$phoneRecieved)";

    $result = mysqli_query($connection, $query);

    mysqli_close($connection);

} else {
    echo "NOT ALL SET";
}

echo <<<_END
<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

_END;
require("templates/head.php");
require("templates/header.php");
echo "<body id='background'>";
echo <<<_END

<h3>Sign Up</h3>
    <form action="signup.php" method="POST">
    <input name="username" minlength="3" maxlength="32" type="text" placeholder="Enter a username"><br><br>
    <input name="password" minlength="5" maxlength="64" type="text" placeholder="Enter a password"><br><br>
    <input name="firstname" minlength="3" maxlength="64" type="text" placeholder="Enter first name"><br><br>
    <input name="lastname" minlength="3" maxlength="64" type="text" placeholder="Enter last name"><br><br>
    <input name="email" minlength="3" maxlength="128" type="email" placeholder="Enter email"><br><br>
    <input name="age" minlength="3" maxlength="3" type="number" placeholder="Enter age"><br><br>
    <input name="city" minlength="3" maxlength="32" type="text" placeholder="Enter city"><br><br>
    <input name="county" minlength="3" maxlength="40" type="text" placeholder="Enter county"><br><br>
    <input name="country" minlength="3" maxlength="60" type="text" placeholder="Enter country"><br><br>
    <input name="phone" minlength="10" maxlength="24" type="number" placeholder="Enter phone number"><br><br>

    <br><button type="submit">Submit</button>
    </form>

_END;
require "templates/footer.php";
echo <<<_END
</body>
</html>
_END;
?>

