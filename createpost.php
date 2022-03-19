<?php

echo <<<_END
<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

_END;
require "templates/head.php";
require "templates/header.php";
echo "<body id='background'>";

require_once "credentials.php";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if(!$connection) {
    die("Connection failed".$mysqli_connect_error);
}

function prepare($string){
    return "'" . $string . "'";
}

if(isset($_POST["title"]) &&
    isset($_POST["content"]) && 
    isset($_POST["image"])) {

    $titleRecieved = prepare($_POST["title"]);
    $created = prepare(date("Y/m/d H:i:s"));
    $contentRecieved = prepare($_POST["content"]);
    //$imageRecieved = prepare($_POST["image"]);

    $userWhoPosted = ($loggedIn ? "'" . $userID . "'" : NULL);
    // echo $userWhoPosted;

    $query = "INSERT INTO posts (uid, title, created, content)
    VALUES ($userWhoPosted, $titleRecieved,$created, $contentRecieved)";
    // echo $query;

    $result = mysqli_query($connection, $query);

    mysqli_close($connection);

} else {
    // echo "NOT ALL SET";
}


echo <<<_END

<form action="createpost.php" method="POST">
<label for="createposts"><br><b>Create Post</b></br></label><br><br>
<input name="title" minlength="5" maxlength="120" type="text" placeholder="Enter your post title"><br><br>
<input name="content" minlength="3" maxlength="800" type="text" placeholder="Enter your post description"><br><br>
<input name="image" type="file" placeholder="Drop in your image"><br><br>
<br><button type="submitPost">Submit Post</button>
</form>

_END;
require "templates/footer.php";
echo <<<_END
</body>
</html>
_END;

?>
