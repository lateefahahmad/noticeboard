<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "noticeboard";

echo <<<_END
<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

_END;
require "templates/head.php";
require "templates/header.php";
echo "<body id='background'>";

if($loggedIn) {
    if(isset($_POST["postid"])) {
        $postid = intval($_POST["postid"]);
        echo $postid;
        echo gettype($postid);
        $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
        // if the connection fails, we need to know, so allow this exit:
        if (!$connection)
        {
            die("Connection failed: " . $mysqli_connect_error);
        }
        if(isset($_POST["uid"])) {
            if($_POST["uid"] == $userID || $username == "admin") {
                $query = "DELETE FROM posts WHERE postid = $postid";
                $result = mysqli_query($connection, $query);
                echo $result;
                echo "post deleted";
            } else {
                echo "not authorised to delete post";
            }
        } elseif($username == "admin") {
            $query = "DELETE FROM posts WHERE postid = $postid";
            $result = mysqli_query($connection, $query);
            echo $result;
            echo "post deleted by admin";
            
        } else {
            echo "not authorised to delete post";
        }
        mysqli_close($connection);
        header('location: posts.php');
    }
}


require "templates/footer.php";
echo <<<_END
</body>
</html>
_END;
?>
