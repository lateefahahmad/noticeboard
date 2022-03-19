<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "noticeboard";

echo <<<_END
<!DOCTYPE html>
<html lang="en">
_END;
require "templates/head.php";
require "templates/header.php";
echo "<body id='background'>";

if($loggedIn) {
    if(isset($_POST["postid"])) {
        if(isset($_POST["changesprovided"])) {
            $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
            // if the connection fails, we need to know, so allow this exit:
            if (!$connection)
            {
                die("Connection failed: " . $mysqli_connect_error);
            }

            if($_POST["userid"] == $userID || $username == "admin") {
                $whereClause = " WHERE postid = {$_POST['postid']}";
                if(isset($_POST["title"]) && isset($_POST["content"]) && isset($_POST["image"]))  {
                
                    if ($_POST["title"] != "") {
                        $title = htmlentities(mysqli_real_escape_string($connection, $_POST["title"]));
                        $queryt = "UPDATE posts SET title = '{$title}'" . $whereClause;
                        $result = mysqli_query($connection, $queryt);
                        echo $result;
                    }

                    if ($_POST["content"] != "") {
                        $content = htmlentities(mysqli_real_escape_string($connection, $_POST["content"]));
                        $queryc = "UPDATE posts SET content = '{$content}'" . $whereClause;
                        $result = mysqli_query($connection, $queryc);
                        echo $result;
                    }
                    // if ($_POST["title"] != "") {
                    //     # code...
                    // }

                    header('location: posts.php');                    
                    
                } else {
                    echo "cannot update";
                }     
                mysqli_close($connection);
            }
        } else {
            echo "you are editing post {$_POST["postid"]}";
            echo <<<_END
                    <form action="editpost.php" method="POST">
                    <label for="editposts">Edit Post Details</label><br><br>
                    <input name="title" type="text" placeholder="Edit Title"><br><br>
                    <input name="content" type="text" placeholder="Edit Post Content"><br><br>
                    <input name="image" type="text" placeholder="Change Image"><br><br>
                    <input name="changesprovided" value="true" type="hidden">
                    <input name="postid" value="{$_POST["postid"]}" type="hidden">
                    <input name="userid" value="{$_POST["userid"]}" type="hidden">
                    <br><button type="submit">Save Changes</button>
                    </form>
                    // FORM TO EDIT HERE
                    _END;
        }  
    } else {
        echo "no postid provided";
    }
}else {
    echo "not logged in";
}

//check postid is set
// check if user id / admin == userid on posts
// check if post variables r set if(isset( title content post img) elseif 24
//     if each check each field == "" 
//     return back to header
//     otherwise update database post
//     $query = "UPDATE posts SET title = $_POST["title"]
//     make seperate queries for each field check
//     then return back to post page (header :)


// elseif(!postvariables r set) {
//     form for editing (posttitle)













echo "</body>";
?>