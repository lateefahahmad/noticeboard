<?php

require_once 'credentials.php';
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if(!$connection) {
    die("Connection failed".$mysqli_connect_error);
}

echo <<<_END
<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

_END;
require "templates/head.php";
require "templates/header.php";
echo "<body id='background'>";

// CHECK THESE ARE WORKING ----
$baseQuery = "SELECT * FROM posts LEFT JOIN users USING(uid)";
$query = "";
$filter = "";
// $querydateAsc = $baseQuery . " ORDER BY created ASC";

// $queryAnnon = $baseQuery . " WHERE uid IS NULL";

// $querydateDesc = $baseQuery . " ORDER BY created DESC";

// $queryUserPosts = $baseQuery . "SELECT * FROM posts";

if(isset($_POST["filter"])) {

    if($_POST["filter"] == "allPosts") {
        $query = $baseQuery;
    } elseif($_POST["filter"] == "myPosts") {
     $query = $baseQuery . " WHERE uid = {$userID}";
    }
} else {
    $query = $baseQuery;
    
}

if(isset($_POST["orderby"])) {
    $query = $query . " ORDER BY created {$_POST["orderby"]}";
}

$result = mysqli_query($connection, $query);

echo <<<_END
    <form action="posts.php" method="post">
    <label for="orderby">Order By:</label>
    <select name="orderby" class="form-select form-select-sm" aria-label=".form-select-sm example"><br>
    <option value="ASC">Oldest (ASC)</option>
    <option value="DESC"selected>Newest (DESC)</option>
    </select>
    <label for="filter">Filter Posts By:</label>
    <select name="filter" class="form-select form-select-sm" aria-label=".form-select-sm example"><br>
    <option value="allPosts"selected>All Posts</option>
    <option value="myPosts">Posts By Me</option>
    </select><br>
    <button class="btn btn-outline-primary btn-sm" type="submit">apply filter</button>
    </form>
    <div class="container">
    <div class="row row-cols-3">

_END;

while($row = mysqli_fetch_assoc($result)) {
    $img = ($row["image"] == NULL ? "img/noimg.jpg" : $row["image"]);
    $author = ($row["uid"] == NULL ? "Anonymous User" : $row["firstname"] . " " . $row["lastname"]);
    
    echo <<<_END

        <div class='card-group'>
        <div class="col card text-start card mb-6" style="width: 20rem;">
        <img src="{$img}" class="card-img-top" alt="image">
        <div class="card-body">
        <h5 class="card-title">{$row["title"]}</h5>
        <h6 class="card-title">By: {$author}</h6>
        <p class="card-text">{$row["content"]}</p>
        </div>

        <div class="card-body">
        <form action="editpost.php" method="post">
        <button name="" class="card-link btn btn-primary">Edit</button>
        <input name="postid" type="hidden" value="{$row["postid"]}"/>
        <input name="userid" type="hidden" value="{$row["uid"]}"/>

        </form>
        <form action="deletepost.php" method="post">
        <button name="" class="card-link btn btn-danger" btn btn-primary">Delete Post</button>
        <input name="postid" type="hidden" value="{$row["postid"]}"/>
        <input name="userid" type="hidden" value="{$row["uid"]}"/>
        </form>
        </div>
        </div>
        </div>
       

    _END;

}
echo "</div>";
require "templates/footer.php";
echo <<<_END
</body>
</html>
_END;

?>