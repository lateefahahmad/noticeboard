<?php
session_start();
$_SESSION = array();
setcookie(session_name(), " ", time() - 1000000);
session_destroy();
header("Location: signin.php");
?>