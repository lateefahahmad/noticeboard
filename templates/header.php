<?php
session_start();
$loggedIn = false;
$username = "";
$userID = 0;


if(isset($_SESSION["loggedIn"])) {
    $loggedIn = $_SESSION["loggedIn"];
    $username = $_SESSION["username"];
    $userID = $_SESSION["uid"];

}


if(!$loggedIn){
    echo "Anonymous User";
 } else {
        echo "Logged in $username";
    }

//bootstrap classes nav bar
echo <<<_END
<header>


<table>
<tr>
   <button type="button" class="btn btn-outline-secondary btn-sm"<td class="cell-data" onclick="changeColour('dark')">Dark Theme</td></button>
   <button type="button" class="btn btn-outline-secondary btn-sm"<td class="cell-data" onclick="changeColour()">Light Theme</td></button>
</tr>        
</table>    

<table id="tasks"></table>
<h1>Lateefah's Noticeboard</h1> 

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Noticeboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        <a class="nav-link" href="posts.php">View Posts</a>
        <a class="nav-link" href="createpost.php">Create Post</a>
_END;

echo "<body>";
//background image will not work // <img src="img/indexbg.jpg" alt ="noticeboard">
      if($loggedIn) {
        echo <<<_END
        <a class="nav-link" href="signout.php">Sign Out ($username)</a>
        <a class="nav-link" href="userdetails.php">View My Details...</a>
    
        _END;
      } else {
        echo <<<_END
        <a class="nav-link" href="signin.php">Sign In</a>
        <a class="nav-link" href="signup.php">Sign Up</a>
        _END;
      }
        
echo <<<_END
      </div>
    </div>
  </div>
</nav>
<div id="time" class="time"></div>
</ul>
</header>
_END;

?>  