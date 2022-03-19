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


require("templates/head.php");
require("templates/header.php");
echo "<body>";

require_once "credentials.php";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if(!$connection) {
    die("Connection failed".$mysqli_connect_error);
}

if (!$loggedIn)
{
    // user isn't logged in, display a message saying they must be:
    echo "You must be logged in to view this page.";
} else {
    echo "hi";
    $connection;    
    $query = "SELECT * FROM posts WHERE uid='$userID' ORDER BY created ";

// this query can return data ($result is an identifier):
    $result = mysqli_query($connection, $query);
    // how many rows came back?:
    $n = mysqli_num_rows($result);
    
if ($n > 0) {

    // get the data back as an associative array
    // should be a single row of data - usernames are unique (primary key)!
    $profile = mysqli_fetch_assoc($result);

    }  
}

// we're finished with the database, close the connection:
mysqli_close($connection);
// check that there is some data to show

echo <<<_END
<table class="table table-success table-striped">
<b>My Posts: </b><br>
<tr>
    <td colspan="2" bgcolor="#fdf5e6">Post ID: </td><td>{$profile['postid']}</td>
</tr>
<tr>
    <td colspan="2" bgcolor="#fdf5e6">User ID: </td><td>{$profile['uid']}</td>
</tr>
<tr>
    <td colspan="2" bgcolor="#fdf5e6">Title: </td><td>{$profile['title']}</td>
</tr>
<tr>
    <td colspan="2" bgcolor="#fdf5e6">Created: </td><td>{$profile['created']}</td>
</tr>
<tr>
    <td colspan="2" bgcolor="#fdf5e6">Content: </td><td>{$profile['content']}</td>
</tr>
<tr>
    <td colspan="2" bgcolor="#fdf5e6">Image: </td><td>{$profile['image']}</td>
</tr>
</table>
<button type="button" class="btn btn-primary">Edit Details</button>

</body>
</html>
_END;
require "templates/footer.php";
?> 

