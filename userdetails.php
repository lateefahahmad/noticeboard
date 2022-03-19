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
echo "<body id='background'>";



if (!isset($_SESSION['loggedIn']))
{
    // user isn't logged in, display a message saying they must be:
    echo "You must be logged in to view this page.<br>";
}
else
{
    // user is already logged in, read all the favourite films and display in a table:

    // connect directly to our database (notice 4th argument):
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    // if the connection fails, we need to know, so allow this exit:
    if (!$connection)
    {
        die("Connection failed: " . $mysqli_connect_error);
    }
}

// find our particular, logged-in user
$query = "SELECT * FROM users WHERE username='{$_SESSION['username']}'";

// this query can return data ($result is an identifier):
$result = mysqli_query($connection, $query);

// how many rows came back?:
$n = mysqli_num_rows($result);

// check that there is some data to show
if ($n > 0) {

    // get the data back as an associative array
    // should be a single row of data - usernames are unique (primary key)!
    $profile = mysqli_fetch_assoc($result);

    // display the user's profile data in a table for easy reading
    echo <<<_END


<table class="table table-success table-striped">
<b>Profile Data: </b><br>
<tr>
    <td colspan="2" bgcolor="#fdf5e6">Username: </td><td>{$profile['username']}</td>
</tr>
<tr>
    <td colspan="2" bgcolor="#fdf5e6">Password: </td><td>{$profile['password']}</td>
</tr>
<tr>
    <td colspan="2" bgcolor="#fdf5e6">First name: </td><td>{$profile['firstname']}</td>
</tr>
<tr>
    <td colspan="2" bgcolor="#fdf5e6">Last name: </td><td>{$profile['lastname']}</td>
</tr>
<tr>
    <td colspan="2" bgcolor="#fdf5e6">Email: </td><td>{$profile['email']}</td>
</tr>
<tr>
    <td colspan="2" bgcolor="#fdf5e6">Age: </td><td>{$profile['age']}</td>
</tr>
<tr>
    <td colspan="2" bgcolor="#fdf5e6">City: </td><td>{$profile['city']}</td>
</tr>
<tr>
    <td colspan="2" bgcolor="#fdf5e6">County: </td><td>{$profile['county']}</td>
</tr>
<tr>
    <td colspan="2" bgcolor="#fdf5e6">Country: </td><td>{$profile['country']}</td>
</tr>
<tr>
    <td colspan="2" bgcolor="#fdf5e6">Phone Number: </td><td>{$profile['phone']}</td>
</tr>
</table>
<button type="button" class="btn btn-primary">Edit Details</button>

_END;
}

else {
    echo "<br>No data returned!<br>";
}

// we're finished with the database, close the connection:
mysqli_close($connection);


echo <<<_END
</body>
<script src="javaScript.js"></script>
</html>
_END;
include("templates/footer.php");
?>

