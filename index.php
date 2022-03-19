<?php
$thing;

// if(isset($_POST["postname"]) != NULL) {
//     $thing = $_POST["postname"];
//     setcookie("specialName", $_POST["postname"]);
// } elseif (isset($_COOKIE["specialName"]) != NULL) {
//     $thing = $_COOKIE["specialName"];
// } else {
//     $thing = "NO ONE";
// }


echo <<<_END
<!DOCTYPE html>
<html lang="en">
_END;

require("templates/head.php");
require("templates/header.php");
echo "<body id=\"background\">";

// echo <<<_END
// <h1>We recieved $thing</h1>
// <form action="index.php" method="POST">
// <label for="name-box">What is your name?</label>
// <input name="postname" type="text" placeholder="Please enter your name!">
// <button>Submit</button>
// </form>   
// echo <<<_END
// <br>
// <input id="title" placeholder="Title">
//         <input id="priority" placeholder="Priority">
//         <input id="description" placeholder="Description">
//         <button onclick="createTask()">Create</button>

// _END;

include "templates/footer.php";
echo <<<_END
</body>
</html>
_END;
?>